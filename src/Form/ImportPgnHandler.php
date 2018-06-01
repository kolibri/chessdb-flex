<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\ImportPgn;
use App\Repository\ImportPgnRepository;

class ImportPgnHandler
{
    private $repository;

    public function __construct(ImportPgnRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(ImportPgn $importPgn)
    {
        $this->repository->persist($importPgn);
    }
}
