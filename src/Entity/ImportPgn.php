<?php declare(strict_types=1);

namespace App\Entity;

use App\Validator\Contraints\Pgn;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @Entity()
 */
class ImportPgn
{
    /**
     * @Id()
     * @Column(type="uuid", unique=true)
     * @GeneratedValue(strategy="CUSTOM")
     * @CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @Column(type="text")
     * @NotBlank()
     * @Pgn()
     */
    private $pgnString;

    /**
     * @Column(type="datetime_immutable")
     */
    private $createdAt;

    public function __construct(string $pgnString)
    {
        $this->pgnString = $pgnString;
        $this->createdAt = new \DateTimeImmutable('now');
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getPgnString(): string
    {
        return $this->pgnString;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
