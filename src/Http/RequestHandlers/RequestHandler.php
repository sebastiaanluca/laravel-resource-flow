<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Http\RequestHandlers;

use Illuminate\Routing\Controller;

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
        // Use app to make the call so method dependency injection can be used when desired
        return app()->call(
            [$this, 'handle'],
            func_get_args()
        );
    }
}
