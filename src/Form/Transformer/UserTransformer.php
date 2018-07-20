<?php declare(strict_types=1);

namespace App\Form\Transformer;

use App\Entity\User;
use App\Form\Dto\UserRegistration;
use App\Form\Exception\TransformException;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserTransformer
{
    private $encoders;
    private $validator;

    public function __construct(EncoderFactoryInterface $encoders, ValidatorInterface $validator)
    {
        $this->encoders = $encoders;
        $this->validator = $validator;
    }

    public function fromDtoToEntity(UserRegistration $dto): User
    {
        $user = new User(
            (string) $dto->getUsername(),
            (string) $dto->getEmail(),
            $this->encoders->getEncoder(User::class)->encodePassword($dto->getPassword(), $dto->getSalt())
        );

        $violations = $this->validator->validate($user);

        if ($violations->count() > 0) {
            throw new TransformException(sprintf('Could not transform to valid object.'));
        }

        return $user;
    }
}
