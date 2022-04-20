<?php

declare(strict_types=1);

use Symfony\Component\Validator\Constraints as Assert;

class Bank
{
    /**
     * @Assert\NotBlank()
     */
    private ?string $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="float")
     */
    private ?float $interestRate;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="float")
     */
    private ?float $maxCredit;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="float")
     */
    private ?float $initialFee;

    /**
     * @Assert\Type(type="int")
     */
    private ?int $term;

    private bool $isPublic = false;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getInterestRate(): ?float
    {
        return $this->interestRate;
    }

    public function setInterestRate(?float $interestRate): void
    {
        $this->interestRate = $interestRate;
    }

    public function getMaxCredit(): ?float
    {
        return $this->maxCredit;
    }

    public function setMaxCredit(?float $maxCredit): void
    {
        $this->maxCredit = $maxCredit;
    }

    public function getInitialFee(): ?float
    {
        return $this->initialFee;
    }

    public function setInitialFee(?float $initialFee): void
    {
        $this->initialFee = $initialFee;
    }

    public function getTerm(): ?int
    {
        return $this->term;
    }

    public function setTerm(?int $term): void
    {
        $this->term = $term;
    }

    public function hasIsPublic(): bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    public static function serializationEntity(\App\Entity\Banks $banks): self
    {
        $bank = new self();
        $bank->setTerm($banks->getTerm());
        $bank->setName($banks->getName());
        $bank->setMaxCredit($banks->getMaxCredit());
        $bank->setInterestRate($banks->getInterestRate());
        $bank->setInitialFee($banks->getInitialFee());
        $bank->setIsPublic($banks->hasPublic());

        return $bank;
    }
}