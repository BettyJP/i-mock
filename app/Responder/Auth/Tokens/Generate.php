<?php

namespace App\Responder\Auth\Tokens;

use Illuminate\Http\Exceptions\HttpResponseException;

class Generate
{
    public function invalidAuthorization()
    {
        return response()->json([
            'error_description' => 'invalid Authorization',
            'error' => 'invalid_request',
        ], 200);
    }

    public function invalidClient()
    {
        return response()->json([
            'error_description' => 'invalid Client Info',
            'error' => 'invalid_request',
        ], 200);
    }

    public function failedUpdateToken()
    {
        return response()->json([
            'error_description' => 'failed to update token',
            'error' => 'internal_server_error',
        ], 200);
    }

    public function success(array $tokenInfo)
    {
        return response()->json([
            'access_token' => $tokenInfo['token'],
            'token_type' => 'Bearer',
            'expires_in' => $tokenInfo['expire'],
        ], 200);
    }
}
