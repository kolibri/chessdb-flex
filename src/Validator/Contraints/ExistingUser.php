<?php declare(strict_types=1);

namespace App\Validator\Contraints;

use Symfony\Component\Validator\Constraint;

/** @Annotation */
class ExistingUser extends Constraint
{
    public $message = 'existing_user.not_exist';
}
