<?php
namespace Rzhukovskiy\Recipe\Interfaces;

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
     */
    public function cook(): Context;
}