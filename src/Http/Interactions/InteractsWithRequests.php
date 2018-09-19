<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Http\Interactions;

trait InteractsWithRequests
{
    /**
     * Interact with the request.
     *
     * @param \SebastiaanLuca\Flow\Http\Interactions\Interaction $interaction
     *
     * @return void
     */
    protected function interact(Interaction $interaction) : void
    {
        app()->call([$interaction, 'interact']);
    }
}
