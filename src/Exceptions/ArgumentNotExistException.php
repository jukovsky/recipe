<?php

namespace Rzhukovskiy\Recipe\Exceptions;

use Exception;

class ArgumentNotExistException extends Exception
{
    /**
     * @return string
     */
    public function errorMessage(): string
    {
        return sprintf("Error on line %s in %s:. Argument %s doesn't exist.",
            $this->getLine(),
            $this->getFile(),
            $this->getMessage());
    }
}