<?php
namespace Rzhukovskiy\Recipe\Interfaces;

interface RecipeFactory
{
    /**
     * @return Recipe
     */
    public function make(): Recipe;
}