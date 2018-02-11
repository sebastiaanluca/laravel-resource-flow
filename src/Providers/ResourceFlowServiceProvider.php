<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Providers;

class ResourceFlowServiceProvider extends Provider
{
    /**
     * The lowercase name of the package.
     *
     * @return string
     */
    protected function getPackageName() : string
    {
        return 'flow';
    }
}
