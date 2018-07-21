<?php declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;

class GameInviteRepository
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

}
