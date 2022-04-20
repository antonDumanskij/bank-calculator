<?php

namespace App\Entity;

use App\Repository\BanksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BanksRepository::class)
 */
class Banks
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="banks")
     */
    private User $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name = '';

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private float $interestRate = 0.0;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private float $maxCredit = 0.0;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private float $initialFee = 0.0;

    /**
     * @ORM\Column(type="integer")
     */
    private int $term = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isDelete = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isPublic = false;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    public function setInterestRate(float $interestRate): void
    {
        $this->interestRate = $interestRate;
    }

    public function getMaxCredit(): float
    {
        return $this->maxCredit;
    }

    public function setMaxCredit(float $maxCredit): void
    {
        $this->maxCredit = $maxCredit;
    }

    public function getInitialFee(): float
    {
        return $this->initialFee;
    }

    public function setInitialFee(float $initialFee): void
    {
        $this->initialFee = $initialFee;
    }

    public function getTerm(): int
    {
        return $this->term;
    }

    public function setTerm(int $term): void
    {
        $this->term = $term;
    }

    public function hasDelete(): bool
    {
        return $this->isDelete;
    }

    public function markDelete(): void
    {
        $this->isDelete = true;
    }

    public function hasPublic(): bool
    {
        return $this->isPublic;
    }

    public function setPublic(bool $public): void
    {
        $this->isPublic = $public;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
