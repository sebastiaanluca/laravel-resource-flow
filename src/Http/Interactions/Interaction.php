<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Http\Interactions;

interface Interaction
{
    /**
     * Interact with the request.
     *
     * @return mixed
     */
    public function interact();
}
