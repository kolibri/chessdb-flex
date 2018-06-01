<?php declare(strict_types=1);

namespace App\Form\Handler;

use App\Chess\GameFactory;
use App\Entity\Game;
use App\Form\Dto\ImportPgn;
use App\Repository\GameRepository;

class ImportPgnHandler
{
    private $factory;
    private $gameRepository;

    public function __construct(GameFactory $factory, GameRepository $gameRepository)
    {
        $this->factory = $factory;
        $this->gameRepository = $gameRepository;
    }

    public function handle(ImportPgn $importPgn): Game
    {
        $game = $this->factory->createFromImportPgn($importPgn);

        $this->gameRepository->persist($game);

        return $game;
    }
}
