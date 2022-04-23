<?php

namespace Rzhukovskiy\Recipe\Steps;

use Closure;
use Rzhukovskiy\Recipe\Interfaces\Context;

final class Sum extends AbstractMathStep
{
    /**
     * @inheritDoc
     */
    public function do(Context $context, Closure $next): Context
    {
        $res = 0;
        foreach ($this->getArgs() as $inputArray) {
            $inputArray[] = null;
            [$index, $value] = $inputArray;
            $input = match ($index) {
                'input' => $context->getInputs()[$value],
                'result' => $context->getResults()[$value],
                default => $index,
            };
            $res += $input;
        }
        $context->addResult($res);

        return $next($context);
    }
}