<?php
namespace Rzhukovskiy\Recipe;

use Rzhukovskiy\Recipe\Interfaces\Recipe;
use Rzhukovskiy\Recipe\Interfaces\RecipeFactory;

final class PhpRecipeFactory implements RecipeFactory
{
    private array $config;

    public function __construct($file)
    {
        $this->config = include($file);
    }

    public function make(): Recipe
    {
        $recipe = new WaterfallRecipe(new ArrayContext($this->config['inputs']));

        foreach ($this->config['steps'] as $stepConfig) {
            $className = array_shift($stepConfig);
            $step = new $className($stepConfig);
            $recipe->addStep($step);
        }

        return $recipe;
    }
}