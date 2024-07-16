<?php

namespace App\Service\Auth\Tokens;

use App\Responder\Auth\Tokens\Index as Render;
use App\Repository\Auth\Clients as Repository;

class Index
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

    public function __invoke()
    {
        $clientList = $this->repository->getAll();

        return $this->render->render($clientList);
    }
}
