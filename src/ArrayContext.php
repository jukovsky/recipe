<?php

namespace Rzhukovskiy\Recipe;

use Rzhukovskiy\Recipe\Exceptions\ArgumentNotExistException;

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

    /**
     * @return void
     */
    public function reset(): void
    {
        $this->results = [];
    }

    /**
     * @param array $args
     * @return array
     * @throws ArgumentNotExistException
     */
    public function getInputsByArgs(array $args): array
    {
        $inputs = [];
        foreach ($args as $inputArray) {
            $inputArray[] = null;
            [$index, $value] = $inputArray;
            switch ($index) {
                case 'input':
                    if(!array_key_exists($value, $this->getInputs())) {
                        throw new ArgumentNotExistException("input: $value");
                    }
                    $input = $this->getInputs()[$value];
                    break;
                case 'result':
                    if(!array_key_exists($value, $this->getInputs())) {
                        throw new ArgumentNotExistException("result: $value");
                    }
                    $input = $this->getInputs()[$value];
                    break;
                default:
                    $input = $index;
            }
            $inputs[] = $input;
        }

        return $inputs;
    }
}