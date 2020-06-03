<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractBaseRepository extends ServiceEntityRepository
{
    public function save(object $object = null): void
    {
        if ($object) {
            $this->getEntityManager()->persist($object);
        }

        $this->getEntityManager()->flush();
    }

    public function remove(object $object = null): void
    {
        $this->getEntityManager()->remove($object);
        $this->getEntityManager()->flush();
    }
}
