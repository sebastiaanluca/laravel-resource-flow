<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Http\Interactions;

use Illuminate\Contracts\Bus\Dispatcher;

trait InteractsWithRequests
{
    /**
     * Interact with the request.
     *
     * @param \SebastiaanLuca\Flow\Http\Interactions\Interaction $interaction
     *
     * @return mixed
     */
    protected function interact(Interaction $interaction)
    {
        return app(Dispatcher::class)->dispatchNow($interaction);
    }
}
