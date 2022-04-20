<?php

namespace App\Repository;

use App\Entity\Banks;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class BanksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Banks::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Banks $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Banks $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function getAll(User $user): array
    {
        return $this->createQueryBuilder('b')
            ->where("b.isDelete = false")
            ->andWhere("b.user = :user or b.isPublic = 1")
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    public function searchByParams(float $maxCredit, float $initialFee, User $user): array
    {
        return $this->createQueryBuilder('b')
            ->where("b.isDelete = false")
            ->andWhere("b.user = :user or b.isPublic = 1")
            ->andWhere("b.maxCredit >= :max")
            ->andWhere("b.initialFee <= :initialFee")
            ->setParameter('user', $user)
            ->setParameter('max', $maxCredit)
            ->setParameter('initialFee', $initialFee)
            ->getQuery()
            ->getResult();
    }
}
