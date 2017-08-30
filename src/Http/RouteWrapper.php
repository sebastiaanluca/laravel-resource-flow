<?php

namespace SebastiaanLuca\Flow\Http;

use Illuminate\Routing\Route;

class RouteWrapper
{
    /**
     * @var Route
     */
    protected $route;

    /**
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * @param string $method
     * @param array|null $arguments
     *
     * @return static
     */
    public function __call(string $method, $arguments)
    {
        if (method_exists($this, $method)) {
            $this->$method(...$arguments);
        }
        else {
            $this->route->$method(...$arguments);
        }

        return $this;
    }

    /**
     * @return \Illuminate\Routing\Route
     */
    public function getRoute() : Route
    {
        return $this->route;
    }

    /**
     * Only handle the request if the user has the given permission(s).
     *
     * @param array ...$permissions
     */
    protected function permit(...$permissions)
    {
        $permissions = join('|', $permissions);

        $this->route->middleware("permission:$permissions");
    }
}
