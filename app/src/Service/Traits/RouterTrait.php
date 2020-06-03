<?php

namespace App\Service\Traits;

use Symfony\Component\Routing\RouterInterface;

trait RouterTrait
{
    /** @var RouterInterface */
    protected $router;

    /**
     * @required
     */
    public function setRouter(RouterInterface $router): void
    {
        $this->router = $router;
    }
}
