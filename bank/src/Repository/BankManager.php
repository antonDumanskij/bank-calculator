<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Banks;
use App\Entity\User;

class BankManager
{
    private BanksRepository $repository;

    public function __construct(BanksRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(Banks $bank): void
    {
        $this->repository->add($bank, true);
    }

    public function search(\BankSelection $bankSelect, User $user): array
    {
        return $this->repository->searchByParams($bankSelect->getMaxCredit(), $bankSelect->getInitialFee(), $user);
    }

    /**
     * @return Banks[]
     */
    public function getAll(User $user): array
    {
        return $this->repository->getAll($user);
    }

    public function findForId(int $id): ?Banks
    {
        return $this->repository->find($id);
    }
}