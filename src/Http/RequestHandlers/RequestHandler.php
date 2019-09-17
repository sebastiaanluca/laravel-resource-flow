<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Http\RequestHandlers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use SebastiaanLuca\Flow\Exceptions\InteractionFailed;

class RequestHandler extends Controller
{
    /**
     * Executed when the object itself is called as a method.
     *
     * Pass the call on to a handle method for improved readability.
     *
     * @param array ...$arguments
     *
     * @return mixed
     */
    public function __invoke(...$arguments)
    {
        $trace = last(debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2));
        $parameters = Arr::get($trace, 'args.1');

        try {
            return $this->handleRequest($parameters);
        } catch (InteractionFailed $exception) {
            return $this->getResponseFromException($exception);
        }
    }

    /**
     * Handle the request.
     *
     * @param array $arguments
     *
     * @return mixed
     */
    private function handleRequest($arguments)
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
     * @param \SebastiaanLuca\Flow\Exceptions\InteractionFailed $exception
     *
     * @return mixed
     */
    private function getResponseFromException(InteractionFailed $exception)
    {
        $response = $exception->getResponse();

        if (is_callable($response)) {
            return $response();
        }

        return $response;
    }
}
