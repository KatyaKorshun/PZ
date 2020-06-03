<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;


class UserRepository extends AbstractBaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getUsersListQuery(string $username = null): Query
    {
        $qb = $this->createQueryBuilder('user')
            ->orderBy('user.username', 'ASC');

        if ($username) {
            $qb->where($qb->expr()->like('user.username', ':username'))
                ->setParameter('username', '%' . $username . '%');
        }

        return $qb->getQuery();
    }
}
