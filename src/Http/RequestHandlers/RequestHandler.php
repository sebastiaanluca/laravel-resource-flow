<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Http\RequestHandlers;

use Illuminate\Routing\Controller;
use SebastiaanLuca\Flow\Exceptions\InteractionException;

class RequestHandler extends Controller
{
    /**
     * Executed when the object itself is called as a method.
     *
     * Pass the call on to a handle method for improved readability.
     *
     * @return mixed
     */
    public function __invoke()
    {
        try {
            return $this->handleRequest(func_get_args());
        } catch (InteractionException $exception) {
            return $this->getResponseFromException($exception);
        }
    }

    /**
     * Handle the request.
     *
     * @param array ...$arguments
     *
     * @return mixed
     */
    private function handleRequest(...$arguments)
    {
        if (method_exists($this, 'before')) {
            $response = app()->call([$this, 'before'], $arguments);
        }

        if (isset($response) && $response !== null) {
            return $response;
        }

        return app()->call([$this, 'handle'], $arguments);
    }

    /**
     * @param \SebastiaanLuca\Flow\Exceptions\InteractionException $exception
     *
     * @return mixed
     */
    private function getResponseFromException(InteractionException $exception)
    {
        $response = $exception->getResponse();

        if (is_callable($response)) {
            return $response();
        }

        return $response;
    }
}
