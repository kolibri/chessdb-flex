<?php declare(strict_types=1);

namespace App\Form\Handler;

use App\Entity\Game;
use App\Repository\GameRepository;

class GameHandler
{
    private $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Game $game)
    {
        $this->repository->persist($game);
    }
}
