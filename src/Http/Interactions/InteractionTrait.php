<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Http\Interactions;

use SebastiaanLuca\Flow\Exceptions\InteractionException;

trait InteractionTrait
{
    /**
     * Fail the interaction with the request and return a response early.
     *
     * @param mixed $response
     *
     * @throws \SebastiaanLuca\Flow\Exceptions\InteractionException
     */
    private function failedInteraction($response) : void
    {
        throw InteractionException::failed($response);
    }
}
