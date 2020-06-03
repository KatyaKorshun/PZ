<?php

namespace App\Service\Traits;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

trait TokenStorageTrait
{
    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /**
     * @required
     */
    public function setTokenStorage(TokenStorageInterface $tokenStorage): void
    {
        $this->tokenStorage = $tokenStorage;
    }
}
