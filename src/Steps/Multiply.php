<?php

namespace Rzhukovskiy\Recipe\Steps;

use Closure;
use Rzhukovskiy\Recipe\Interfaces\Context;

final class Multiply extends AbstractMathStep
{
    /**
     * @inheritDoc
     */
    public function do(Context $context, Closure $next): Context
    {
        $res = 1;
        $inputs = $context->getInputsByArgs($this->getArgs());
        foreach ($inputs as $input) {
            $res *= $input;
        }
        $context->addResult($res);

        return $next($context);
    }
}