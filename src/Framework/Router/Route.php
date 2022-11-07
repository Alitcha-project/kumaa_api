<?php

namespace Kumaa\Framework\Router;

use function PHPUnit\Framework\callback;

/**
 * Route
 */
class Route
{

    /**
     * name
     *
     * @var string
     */
    private $name = null;
    
    /**
     * callback
     *
     * @var callable
     */
    private $callback = null;
    
    /**
     * parameters
     *
     * @var array
     */
    private $parameters = [];
    
    /**
     * __construct
     *
     * @param  mixed $name
     * @param  mixed $callback
     * @param  mixed $parameters
     * @return void
     */
    public function __construct(string $name, callable $callback, array $parameters = [])
    {
        $this->name = $name;
        $this->callback = $callback;
        $this->parameters = $parameters;
    }

    /**
     * getName
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * getCallback
     *
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }
    
    /**
     * getParams
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->parameters;
    }
}
