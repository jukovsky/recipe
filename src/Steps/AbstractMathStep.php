<?php

namespace Rzhukovskiy\Recipe\Steps;

use Rzhukovskiy\Recipe\Interfaces\Step;

abstract class AbstractMathStep implements Step
{
    private array $args;

    public function __construct(array $args)
    {
        $this->args = $args;
    }

    public function getArgs(): array
    {
        return $this->args;
    }
}