<?php

namespace App\Responder\Auth\Tokens;

class Index
{
    /**
     * @param array $clientList
     */
    public function render(
        array $clientList
    )
    {
        $viewData = [
            'clientList' => $clientList,
        ];

        return view('Auth/Tokens', $viewData);
    }
}
