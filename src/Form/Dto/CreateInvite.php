<?php declare(strict_types=1);

namespace App\Form\Dto;

use App\Validator\Contraints\ExistingUser;
use Symfony\Component\Validator\Constraints\Choice;

class CreateInvite
{
    /** @ExistingUser(message="create_game_invite.invited.not_exist") */
    private $invited;

    /** @Choice(choices={"0", "w", "b"}, message="create_game_invite.color.invalid") */
    private $color;
}
