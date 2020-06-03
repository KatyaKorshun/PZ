<?php

namespace App\Service\Traits;

use Doctrine\ORM\EntityManagerInterface;

trait EntityManagerTrait
{
    /** @var EntityManagerInterface */
    protected $em;

    /**
     * @required
     */
    public function setEntityManager(EntityManagerInterface $entityManager): void
    {
        $this->em = $entityManager;
    }
}
