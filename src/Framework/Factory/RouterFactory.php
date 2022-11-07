<?php

namespace Kumaa\Framework\Factory;

use Kumaa\Framework\Router\Router;
use Psr\Container\ContainerInterface;

class RouterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new Router();
    }
}
