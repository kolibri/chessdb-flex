<?php declare(strict_types=1);

namespace App\Form\Handler;

use App\Form\Dto\UserRegistration;
use App\Form\Transformer\UserTransformer;
use App\Repository\UserRepository;

class UserRegistrationHandler
{
    private $repository;
    private $userTransformer;

    public function __construct(UserRepository $repository, UserTransformer $userTransformer)
    {
        $this->repository = $repository;
        $this->userTransformer = $userTransformer;
    }

    public function handle(UserRegistration $user): void
    {
        $this->repository->persist(
            $this->userTransformer->fromDtoToEntity($user)
        );
    }
}
