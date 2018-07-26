<?php

namespace SebastiaanLuca\Flow\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * @param $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            //
        ];
    }
}
