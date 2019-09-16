<?php

declare(strict_types=1);

/**
 * Call the given Closure / class@method and inject its dependencies.
 *
 * @param callable|string $callback
 * @param array $parameters
 * @param string|null $defaultMethod
 *
 * @return mixed
 */
function flow_call_method($callback, array $parameters = [], $defaultMethod = null)
{
    if (is_array($callback)) {
        $callback = Closure::fromCallable($callback);
    }

    $reflection = new ReflectionFunction($callback);
    $functionParameters = collect($reflection->getParameters());

    $namedParameters = collect($parameters)
        ->mapWithKeys(function ($item, $key) use ($functionParameters) : array {
            return [optional($functionParameters->get($key))->getName() ?? $key => $item];
        })
        ->all();

    return app()->call($callback, $namedParameters, $defaultMethod);
}
