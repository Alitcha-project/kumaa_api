<?php

namespace Kumaa\Modules;

use Kumaa\Framework\Router\Router;

class Module
{
    const MIGRATION = null;
    const SEED = null;
    const DEFINITIONS = null;

    protected $router = null;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }
}
