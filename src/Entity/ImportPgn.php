<?php declare(strict_types=1);

namespace App\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Ramsey\Uuid\UuidInterface;
use App\Validator\Contraints\Pgn;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Entity()
 */
class ImportPgn
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @Column(type="text")
     * @Assert\NotBlank()
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
