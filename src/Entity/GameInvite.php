<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * @Entity()
 */
class GameInvite
{
    /**
     * @Id()
     * @Column(type="uuid", unique=true)
     * @GeneratedValue(strategy="CUSTOM")
     * @CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var User
     * @OneToOne(targetEntity="User")
     * @JoinColumn(name="inviter_id", referencedColumnName="id")
     */
    private $inviter;

    /**
     * @var User
     * @OneToOne(targetEntity="User")
     * @JoinColumn(name="invited_id", referencedColumnName="id")
     */
    private $invited;

    /**
     * @Column(type="datetime_immutable")
     */
    private $acceptedAt;

    /**
     * @Column(type="datetime_immutable")
     */
    private $declinedAt;

    /**
     * @Column(type="datetime_immutable")
     */
    private $retiredAt;

    /**
     * @Column(type="datetime_immutable")
     */
    private $createdAt;
}
