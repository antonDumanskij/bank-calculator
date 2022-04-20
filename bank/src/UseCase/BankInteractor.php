<?php

declare(strict_types=1);

namespace App\UseCase;

use App\Entity\Banks;
use App\Entity\User;
use App\Repository\BankManager;
use Bank;

class BankInteractor
{
    private BankManager $bankManager;

    public function __construct(BankManager $bankManager)
    {
        $this->bankManager = $bankManager;
    }

    public function search(\BankSelection $bankSelect, User $user): array
    {
        return $this->bankManager->search($bankSelect, $user);
    }

    public function findById(int $id): Banks
    {
        $bank = $this->bankManager->findForId($id);
        if (!$bank) {
            throw new \Exception("Not found");
        }

        return $bank;
    }

    /**
     * @return Banks[]
     */
    public function getAll(User $user): array
    {
        return $this->bankManager->getAll($user);
    }

    public function create(Bank $request, User $user): void
    {
        $bank = new Banks($user);
        $bank->setInitialFee($request->getInitialFee());
        $bank->setInterestRate($request->getInterestRate());
        $bank->setMaxCredit($request->getMaxCredit());
        $bank->setName($request->getName());
        $bank->setTerm($request->getTerm());
        $bank->setPublic($request->hasIsPublic());

        $this->bankManager->save($bank);
    }

    public function isOwner(User $user, int $id): bool
    {
        $bank = $this->bankManager->findForId($id);
        if (!$bank) {
            return false;
        }
        if ($bank->getId() === $id) {
            return true;
        }

        return false;
    }

    public function delete(int $id): void
    {
        $bank = $this->bankManager->findForId($id);
        if (!$bank) {
            throw new \Exception("Don't find bank");
        }

        $bank->markDelete();
        $this->bankManager->save($bank);
    }

    public function edit(int $id, Bank $request): void
    {
        $bank = $this->bankManager->findForId($id);
        if (!$bank) {
            throw new \Exception("Don't find bank");
        }

        $bank->setInitialFee($request->getInitialFee());
        $bank->setInterestRate($request->getInterestRate());
        $bank->setMaxCredit($request->getMaxCredit());
        $bank->setName($request->getName());
        $bank->setTerm($request->getTerm());
        $bank->setPublic($request->hasIsPublic());

        $this->bankManager->save($bank);
    }

    public function calculMonthlyPayments(array $banks, \BankSelection $params): array
    {
        $monthlyPayments = [];
        foreach ($banks as $bank) {
            $monthlyPayments[$bank->getId()] = $this->calcul($bank, $params->getMaxCredit());
        }

        return $monthlyPayments;
    }

    private function calcul(Banks $bank, float $borrowed): float
    {
        return ($borrowed*($bank->getInterestRate()/12)* ((1 + $bank->getInterestRate() / 12) ** $bank->getTerm()))/(((1 + $bank->getInterestRate() / 12) ** $bank->getTerm())-1);
    }
}