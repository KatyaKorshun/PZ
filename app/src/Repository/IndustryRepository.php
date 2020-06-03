<?php

namespace App\Repository;

use App\Entity\Industry;
use Doctrine\Common\Persistence\ManagerRegistry;

class IndustryRepository extends AbstractBaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Industry::class);
    }
}
