<?php

namespace SebastiaanLuca\Flow\Http;

class RequestHandler
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
        return call_user_func_array([$this, 'handle'], func_get_args());
    }
}
