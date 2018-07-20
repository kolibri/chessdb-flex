<?php declare(strict_types=1);

namespace App\Form\Transformer;

use App\Entity\User;
use App\Form\Dto\UserRegistration;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserTransformer
{
    private $encoders;

    public function __construct(EncoderFactoryInterface $encoders)
    {
        $this->encoders = $encoders;
    }

    public function fromDtoToEntity(UserRegistration $dto): User
    {
        return new User(
            $dto->getUsername(),
            $dto->getEmail(),
            $this->encoders->getEncoder(User::class)->encodePassword($dto->getPassword(), $dto->getSalt())
        );
    }
}
