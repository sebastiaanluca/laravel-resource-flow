<?php

namespace SebastiaanLuca\Flow\Http;

use BadMethodCallException;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;

trait ShorthandRoutes
{
    /**
     * @param string $method
     * @param array|null $arguments
     *
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function __call(string $method, $arguments)
    {
        if (! in_array(strtoupper($method), Router::$verbs)) {
            throw new BadMethodCallException;
        }

        [$uri, $name, $handler] = $arguments;

        return $this->router->{$method}($uri, ['as' => $name, 'uses' => $handler]);
    }

    /**
     * @param string $uri
     * @param string $name
     * @param string $view
     * @param array $data
     *
     * @return \Illuminate\Routing\Route
     */
    protected function view(string $uri, string $name, string $view, array $data = []) : Route
    {
        return $this->router->view($uri, $view, $data)->name($name);
    }
}
