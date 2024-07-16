<?php

namespace App\Repository\Auth;

use App\Models\Auth\Clients as Model;

class Clients
{
    public function getAll(): array
    {
        return Model::select(
            [
                'client_id',
                'client_secret',
                'token',
                'expire'
            ]
        )->get()->toArray();
    }

    public function isValidClient(array $clientInfo): bool
    {
        return Model::where($clientInfo)->exists();
    }

    public function updateToken(string $clientId, array $tokenInfo): int
    {
        return Model::where('client_id', $clientId)->update($tokenInfo);
    }
}
