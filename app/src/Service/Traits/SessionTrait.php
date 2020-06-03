<?php

namespace App\Service\Traits;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

trait SessionTrait
{
    /** @var SessionInterface */
    protected $session;

    /**
     * @required
     */
    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }
}
