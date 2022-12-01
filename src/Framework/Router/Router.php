<?php

namespace Kumaa\Framework\Router;

use Psr\Http\Message\ServerRequestInterface;
use Aura\Router\RouterContainer;

/**
 * Router
 */
class Router
{
    
    /**
     * router
     *
     * @var undefined
     */
    private $router = null;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->router = new RouterContainer();
    }

    /**
     * addRoute
     *
     * @param  mixed $path
     * @param  mixed $callback
     * @param  mixed $name
     * @param  mixed $methode
     * @return void
     */
    public function addRoute(string $path, callable $callback, string $name, string $methode): void
    {
        $map = $this->router->getMap();

        switch ($methode) {
            case 'GET':
                $map->get($name, $path, $callback);
                break;
            case 'POST':
                $map->post($name, $path, $callback);
                break;
            case 'PUT':
                $map->put($name, $path, $callback);
                break;
            case 'DELETE':
                $map->delete($name, $path, $callback);
                break;
            default:
                $map->get($name, $path, $callback);
                break;
        }
    }

    /**
     * matchRoute
     *
     * @param  mixed $request
     * @return Route
     */
    public function matchRoute(ServerRequestInterface $request): ?Route
    {
        $matcher = $this->router->getMatcher();
        $route = $matcher->match($request);

        if ($route) {
            return new Route($route->name, $route->handler, $route->attributes);
        }
        return null;
    }
    
    /**
     * generateUrl
     *
     * @param  mixed $name
     * @param  mixed $params
     * @return string
     */
    public function generateUrl(string $name, array $params) : string
    {
        $generator = $this->router->getGenerator();

        $uri = $generator->generate($name, $params);

        return $uri;
    }
}
