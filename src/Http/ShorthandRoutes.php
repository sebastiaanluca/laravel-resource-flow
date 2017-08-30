<?php

namespace SebastiaanLuca\Flow\Http;

use BadMethodCallException;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use SebastiaanLuca\Flow\Http\Controllers\ResponsableController;

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

    /**
     * @param string $uri
     * @param string $name
     * @param \Illuminate\Contracts\Support\Responsable|string $responsable
     *
     * @return \Illuminate\Routing\Route
     */
    protected function response(string $uri, string $name, $responsable) : Route
    {
        return $this->router->match(['GET', 'HEAD'], $uri, ResponsableController::class)
            ->defaults('responsable', $responsable)
            ->name($name);
    }
}
