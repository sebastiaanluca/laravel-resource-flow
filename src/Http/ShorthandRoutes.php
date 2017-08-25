<?php

namespace SebastiaanLuca\Flow\Http;

trait ShorthandRoutes
{
    /**
     * Register a new named GET route using shorthand notation.
     *
     * @param string $uri
     * @param string $name
     * @param string $handler The controller action or handler that will process the request.
     *
     * @return \Illuminate\Routing\Route
     */
    protected function get(string $uri, string $name, string $handler)
    {
        return $this->router->get($uri, ['as' => $name, 'uses' => $handler]);
    }

    /**
     * Register a new named POST route using shorthand notation.
     *
     * @param string $uri
     * @param string $name
     * @param string $handler The controller action or handler that will process the request.
     *
     * @return \Illuminate\Routing\Route
     */
    protected function post(string $uri, string $name, string $handler)
    {
        return $this->router->post($uri, ['as' => $name, 'uses' => $handler]);
    }
}
