<?php

namespace App\Service\Traits;

use Twig\Environment;

trait TemplatingTrait
{
    /** @var Environment */
    protected $templating;

    /**
     * @required
     */
    public function setTemplating(Environment $templating): void
    {
        $this->templating = $templating;
    }
}
