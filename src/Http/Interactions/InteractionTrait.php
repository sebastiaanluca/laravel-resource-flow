<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Http\Interactions;

use SebastiaanLuca\Flow\Exceptions\InteractionFailed;

trait InteractionTrait
{
    /**
     * Fail the interaction with the request and return a response early.
     *
     * @param mixed $response
     *
     * @throws \SebastiaanLuca\Flow\Exceptions\InteractionFailed
     */
    private function failedInteraction($response) : void
    {
        throw InteractionFailed::withResponse($response);
    }
}
