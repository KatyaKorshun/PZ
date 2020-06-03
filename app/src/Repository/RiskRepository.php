<?php

namespace App\Repository;

use App\Entity\Risk;
use Doctrine\Common\Persistence\ManagerRegistry;

class RiskRepository extends AbstractBaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Risk::class);
    }
}
