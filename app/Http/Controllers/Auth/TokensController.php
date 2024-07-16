<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use App\Service\Auth\Tokens\Index as IndexService;
use App\Http\Request\Auth\Generate as Request;
use App\Service\Auth\Tokens\Generate as GenerateService;


class TokensController extends Controller
{
    public function index(
        IndexService $service
    )
    {
        return $service();
    }

    public function generate(
        Request $request,
        GenerateService $service
    )
    {
        return $service($request->all());
    }
}
