<?php
namespace Rzhukovskiy\Recipe;

use Rzhukovskiy\Recipe\Interfaces\Recipe;
use Rzhukovskiy\Recipe\Interfaces\RecipeFactory;

final class PhpRecipeFactory implements RecipeFactory
{
    /**
     * @var array|mixed
     */
    private array $config;

    /**
     * @param string $file
     */
    public function __construct(string $file)
    {
        $this->config = include($file);
    }

    /**
     * @return Recipe
     */
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