<?php

namespace Rzhukovskiy\Recipe\Exceptions;

use Exception;

class EmptyRecipeException extends Exception
{
    /**
     * @return string
     */
    public function errorMessage(): string
    {
        return sprintf("Recipe on line %s in %s: is empty. Provide steps before cooking.",
            $this->getLine(),
            $this->getFile());
    }
}