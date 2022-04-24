<?php

namespace Rzhukovskiy\Recipe\Steps;

use Rzhukovskiy\Recipe\Interfaces\Step;

abstract class AbstractMathStep implements Step
{
    /**
     * @var array
     */
    private array $args;

    /**
     * @param array $args
     */
    public function __construct(array $args)
    {
        $this->args = $args;
    }

    /**
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args;
    }
}