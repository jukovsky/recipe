<?php

namespace Rzhukovskiy\Recipe\Interfaces;

use Closure;

interface Step
{
    /**
     * @param Context $context
     * @param Closure $next
     * @return Closure
     */
    public function do(Context $context, Closure $next): Context;

    /**
     * @return array
     */
    public function getArgs(): array;
}