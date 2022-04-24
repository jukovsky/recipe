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
        [$numerator, $denominator] = $context->getInputsByArgs($this->getArgs());
        $context->addResult($numerator / $denominator);

        return $next($context);
    }
}