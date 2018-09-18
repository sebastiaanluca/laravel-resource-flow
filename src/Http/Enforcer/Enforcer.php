<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Http\Enforcers;

interface Enforcer
{
    /**
     * Determine if the enforced request constraint passes.
     *
     * @return bool
     */
    public function passes() : bool;

    /**
     * Get the error messages to show when enforcing the request fails.
     *
     * @return array
     */
    public function messages() : array;
}
