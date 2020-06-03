<?php

namespace App\Repository;

use App\Entity\Campaign;
use Doctrine\Common\Persistence\ManagerRegistry;

class CampaignRepository extends AbstractBaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campaign::class);
    }
}
