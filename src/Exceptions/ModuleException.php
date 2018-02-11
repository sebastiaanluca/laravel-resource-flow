<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Exceptions;

use RuntimeException;

class ModuleException extends RuntimeException
{
    public static function unableToResolveModuleName()
    {
        return new static('Unable to resolve module name: module.json file not found or no alias specified and no fallback package name provided.');
    }
}
