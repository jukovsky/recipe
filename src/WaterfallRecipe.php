<?php

namespace Rzhukovskiy\Recipe;

use Closure;
use Rzhukovskiy\Recipe\Exceptions\EmptyRecipeException;
use Rzhukovskiy\Recipe\Interfaces\Context;
use Rzhukovskiy\Recipe\Interfaces\Step;

final class WaterfallRecipe implements Interfaces\Recipe
{
    /**
     * @var Context
     */
    private Context $context;
    /**
     * @var Step[]
     */
    private array $steps;

    /**
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @inheritDoc
     */
    public function addStep(Step $step): void
    {
        $this->steps[] = $step;
    }

    /**
     * @inheritDoc
     */
    public function cook(): Context
    {
        if (!count($this->steps)) {
            throw new EmptyRecipeException();
        }

        $this->context->reset();
        $queue = array_reverse($this->steps);

        $reducer = array_reduce($queue, function($nextStep, $step) {
            return function($object) use ($nextStep, $step) {
                return $step->do($object, $nextStep);
            };
        }, $this->wrapContext(function($context) {
            return $context;
        }));

        return $reducer($this->context);
    }

    /**
     * @param Closure $inner
     * @return Closure
     */
    private function wrapContext(Closure $inner): Closure
    {
        return function($context) use($inner) {
            return $inner($context);
        };
    }
}