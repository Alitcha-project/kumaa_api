<?php

namespace Tests\Framework;

use GuzzleHttp\Psr7\ServerRequest;
use Kumaa\Framework\Router\Router;
use Kumaa\Framework\Router\Route;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    private $router = null;

    public function setUp(): void
    {
        $this->router = new Router();
    }

    public function testMatchRoute()
    {
        $request = new ServerRequest("GET", "/articles");
        $this->router->addRoute("/articles", function () {
            return "Hello";
        }, "articles");

        $route = $this->router->matchRoute($request);

        $this->assertEquals("articles", $route->getName());
        $this->assertEquals("Hello", call_user_func($route->getCallback(), [$request]));
    }


    public function testNoMatchRoute()
    {
        $request = new ServerRequest("GET", "/vlog");
        $this->router->addRoute("/articles", function () {
            return "Hello";
        }, "articles");

        $route = $this->router->matchRoute($request);

        $this->assertEquals(null, $route);
    }


    public function testMatchRouteWithParams()
    {
        $request = new ServerRequest("GET", "/articles/mon-article-17");
        $this->router->addRoute("/articles", function () {
            return "Hello";
        }, "articles");
        $this->router->addRoute("/articles/{slug}-{id}", function () {
            return "Hello.params";
        }, "articles.withparams");

        $route = $this->router->matchRoute($request);

        $this->assertEquals("articles.withparams", $route->getName());
        $this->assertEquals("Hello.params", call_user_func($route->getCallback(), [$request]));
    }

    public function testGenerateUrl()
    {
        $this->router->addRoute("/articles/{slug}-{id}", function () {
            return "Hello.params";
        }, "articles.withparams");

        $uri = $this->router->generateUrl("articles.withparams", ["slug" => "mon-article", "id" => "18"]);
    
        $this->assertEquals("/articles/mon-article-18", $uri);
    }
}
