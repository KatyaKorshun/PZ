<?php

namespace App\Service\Traits;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

trait AuthorizationCheckerTrait
{
    /** @var AuthorizationCheckerInterface */
    protected $authorizationChecker;

    /**
     * @required
     */
    public function setAuthorizationChecker(AuthorizationCheckerInterface $authorizationChecker): void
    {
        $this->authorizationChecker = $authorizationChecker;
    }
}
