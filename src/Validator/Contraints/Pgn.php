<?php declare(strict_types=1);

namespace App\Validator\Contraints;

use Symfony\Component\Validator\Constraint;

class Pgn extends Constraint
{
    public $message = 'validator.pgn.message';
}
