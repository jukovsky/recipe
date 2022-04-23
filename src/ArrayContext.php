<?php

namespace Rzhukovskiy\Recipe;

class ArrayContext implements Interfaces\Context
{
    /**
     * @var array
     */
    private array $inputs;
    /**
     * @var array
     */
    private array $results;

    /**
     * @param array $inputs
     */
    public function __construct(array $inputs)
    {
        $this->inputs = $inputs;
    }

    /**
     * @inheritDoc
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @inheritDoc
     */
    public function getLastResult(): mixed
    {
        return $this->results[count($this->results) - 1];
    }

    /**
     * @inheritDoc
     */
    public function addResult(mixed $result): void
    {
        $this->results[] = $result;
    }

    /**
     * @inheritDoc
     */
    public function getInputs(): array
    {
        return $this->inputs;
    }

    public function reset(): void
    {
        $this->results = [];
    }
}