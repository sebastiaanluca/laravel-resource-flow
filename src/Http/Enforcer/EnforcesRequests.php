<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Http\Enforcers;

use Illuminate\Validation\ValidationException;

trait EnforcesRequests
{
    /**
     * Enforce a constraint on the request.
     *
     * @param \SebastiaanLuca\Flow\Http\Enforcers\Enforcer $enforcer
     *
     * @return void
     */
    protected function enforce(Enforcer $enforcer) : void
    {
        if ($enforcer->passes()) {
            return;
        }

        throw ValidationException::withMessages($enforcer->messages());
    }
}
