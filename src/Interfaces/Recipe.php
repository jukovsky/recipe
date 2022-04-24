<?php
namespace Rzhukovskiy\Recipe\Interfaces;

use Rzhukovskiy\Recipe\Exceptions\EmptyRecipeException;

interface Recipe
{
    /**
     * @param Context $context
     */
    public function __construct(Context $context);
    /**
     * @param Step $step
     * @return void
     */
    public function addStep(Step $step): void;

    /**
     * @return Context
     * @throws EmptyRecipeException
     */
    public function cook(): Context;
}