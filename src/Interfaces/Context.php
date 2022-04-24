<?php

namespace Rzhukovskiy\Recipe\Interfaces;

use Rzhukovskiy\Recipe\Exceptions\ArgumentNotExistException;

interface Context
{
    /**
     * @return array
     */
    public function getResults(): array;

    /**
     * @return mixed
     */
    public function getLastResult(): mixed;

    /**
     * @param mixed $result
     * @return void
     */
    public function addResult(mixed $result): void;

    /**
     * @return array
     */
    public function getInputs(): array;

    /**
     * @return void
     */
    public function reset(): void;

    /**
     * @param array $args
     * @return array
     * @throws ArgumentNotExistException
     */
    public function getInputsByArgs(array $args): array;
}