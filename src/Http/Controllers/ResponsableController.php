<?php

namespace SebastiaanLuca\Flow\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Routing\Controller;

class ResponsableController extends Controller
{
    /**
     * @param \Illuminate\Contracts\Support\Responsable|string $responsable
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function __invoke($responsable) : Responsable
    {
        return is_string($responsable) ? app($responsable) : $responsable;
    }
}
