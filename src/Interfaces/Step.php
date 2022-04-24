<?php

namespace Rzhukovskiy\Recipe\Interfaces;

use Closure;
use Rzhukovskiy\Recipe\Exceptions\ArgumentNotExistException;

interface Step
{
    /**
     * @param Context $context
     * @param Closure $next
     * @return Context
     * @throws ArgumentNotExistException
     */
    public function do(Context $context, Closure $next): Context;

    /**
     * @return array
     */
    public function getArgs(): array;
}