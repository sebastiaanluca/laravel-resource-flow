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
 *
 * @throws \RuntimeException
 */
function flow_call_method($callback, array $parameters = [], $defaultMethod = null)
{
    if (is_array($callback)) {
        $callback = Closure::fromCallable($callback);
    }

    $reflection = new ReflectionFunction($callback);
    $functionParameters = $reflection->getParameters();
    $requiredParameters = collect($functionParameters)->reject->isOptional();

    if (count($parameters) < count($requiredParameters)) {
        throw new RuntimeException(sprintf(
            'Cannot call method `%s` on `%s`. Number of given parameters does not equal number of required parameters (%s %s required).',
            $reflection->getName(),
            $reflection->getClosureScopeClass()->getName(),
            $requiredParameters->pluck('name')->join(', ', ' and '),
            $requiredParameters->count() === 1 ? 'is' : 'are'
        ));
    }

    $parameters = collect($parameters)->pad(count($functionParameters), null);

    $parameters = collect($functionParameters)
        ->pluck('name')
        ->combine($parameters)
        ->all();

    return app()->call($callback, $parameters, $defaultMethod);
}
