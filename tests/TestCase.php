<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use SebastiaanLuca\Flow\Providers\ResourceFlowServiceProvider;

class TestCase extends BaseTestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app) : array
    {
        return [
            ResourceFlowServiceProvider::class,
        ];
    }
}
