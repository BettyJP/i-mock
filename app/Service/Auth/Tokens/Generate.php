<?php

namespace App\Service\Auth\Tokens;

use App\Responder\Auth\Tokens\Generate as Render;
use App\Repository\Auth\Clients as Repository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;

class Generate
{
    /** @var Render */
    private $render;
    /** @var Repository */
    private $repository;

    public function __construct(
        Render $render,
        Repository $repository
    )
    {
        $this->render = $render;
        $this->repository = $repository;
    }

    public function __invoke(array $request)
    {
        // リクエストからクライアント情報を取得
        try {
            $clientInfo = $this->decodeAuthrization($request);
        }
        catch (Exception $e) {
            return $this->render->invalidAuthorization();
        }

        // クライアントの認証
        if (!$this->isValidClient($clientInfo)) {
            return $this->render->invalidClient();
        }

        // トークンの更新
        $newTokenInfo = $this->generateTokenInfo();
        if ($this->repository->updateToken($clientInfo['client_id'], $newTokenInfo) === 0) {
            return $this->render->failedUpdateToken();
        }

        return $this->render->success($newTokenInfo);
    }

    private function decodeAuthrization(array $request): array
    {
        if (!empty($request['Authorization'])) {
            $encodedAuthCode = str_replace('Basic ', '', $request['Authorization']);
            $authCode = base64_decode($encodedAuthCode);
            $splitAuthCode = explode(':', $authCode);
            $clientId = $splitAuthCode[0];
            $clientSecret = $splitAuthCode[1];
        }
        else {
            $clientId = $request['client_id'];
            $clientSecret = $request['client_secret'];
        }

        return [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ];
    }

    private function isValidClient(array $clientInfo)
    {
        return $this->repository->isValidClient($clientInfo);
    }

    private function generateTokenInfo()
    {
        return [
            'token' => (string) Str::uuid(),
            'expire' => Carbon::now()->addSeconds(config('app.token_expire'))->format('Y-m-d H:i:s'),
        ];
    }
}
