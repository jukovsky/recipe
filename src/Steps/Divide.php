<?php

namespace Rzhukovskiy\Recipe\Steps;

use Closure;
use Rzhukovskiy\Recipe\Interfaces\Context;

final class Divide extends AbstractMathStep
{
    /**
     * @inheritDoc
     */
    public function do(Context $context, Closure $next): Context
    {
        [$numerator, $denominator] = $this->getArgs();

        $numerator = match ($numerator[0]) {
            'input' => $context->getInputs()[$numerator[1]],
            'result' => $context->getResults()[$numerator[1]],
            default => $numerator[0],
        };

        $denominator = match ($denominator[0]) {
            'input' => $context->getInputs()[$denominator[1]],
            'result' => $context->getResults()[$denominator[1]],
            default => $denominator[0],
        };

        $context->addResult($numerator / $denominator);

        return $next($context);
    }
}