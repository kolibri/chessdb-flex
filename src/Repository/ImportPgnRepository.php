<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\ImportPgn;
use Doctrine\ORM\EntityManagerInterface;

class ImportPgnRepository
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function persist(ImportPgn $importPgn, bool $flush = true): void
    {
        $this->entityManager->persist($importPgn);

        $flush && $this->entityManager->flush();
    }
}
