<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;

class GameRepository
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function persist(Game $game, bool $flush = true): void
    {
        $this->entityManager->persist($game);

        $flush && $this->entityManager->flush();
    }

    public function findAll(): array
    {
        return $this->entityManager->getRepository(Game::class)->findAll();
    }
}
