<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class BankSelection
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="float")
     */
    private ?float $maxCredit = 0.0;
    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="float")
     */
    private ?float $initialFee = 0.0;

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
}