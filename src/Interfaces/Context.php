<?php

namespace Rzhukovskiy\Recipe\Interfaces;

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
}