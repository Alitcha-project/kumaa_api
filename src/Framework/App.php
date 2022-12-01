<?php

namespace Kumaa\Framework;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;
use Kumaa\Framework\Router\Router;
use Psr\Container\ContainerInterface;

/**
 * App
 */
class App
{

    /**
     * modules
     *
     * @var array
     */
    private $modules = [];

    /**
     * container
     *
     * @var undefined
     */
    private $container = null;

    /**
     * __construct
     *
     * @param  mixed $container
     * @param  mixed $modules
     * @return void
     */
    public function __construct(ContainerInterface $container, array $modules)
    {
        $this->container = $container;
        foreach ($modules as $module) {
            $this->modules[] =  $container->get($module);
        }
    }

    /**
     * run
     *
     * @param  mixed $request
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri()->getPath();
        $response = new Response(404, [], "No route match");

        if (!empty($uri) && $uri[-1] === "/") {
            $response = new Response(301);
            $response = $response->withHeader("Location", substr($uri, 0, -1));
            return $response;
        }

        $route = $this->container->get(Router::class)->matchRoute($request);

        if ($route) {
            $attribute = $route->getParams();
            foreach ($attribute as $key => $value) {
                $request = $request->withAttribute($key, $value);
            }
            $response = call_user_func_array($route->getCallback(), [$request]);
        }

        return $response;
    }
}
