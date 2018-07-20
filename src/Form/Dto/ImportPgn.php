<?php declare(strict_types=1);

namespace App\Form\Dto;

use App\Validator\Contraints\Pgn;
use Symfony\Component\Validator\Constraints\NotBlank;

class ImportPgn
{
    /**
     * @NotBlank(message="import.pgn.not_blank")
     * @Pgn()
     */
    private $pgnString;

    public function __construct(?string $pgnString)
    {
        $this->pgnString = $pgnString;
    }

    public function getPgnString(): ?string
    {
        return $this->pgnString;
    }
}
