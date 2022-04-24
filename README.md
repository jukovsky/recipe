# Recipe
Tiny framework with ability to execute operations step-by-step.
It is a part of test task.

Framework allows process execution.
A process within the scope of this task is a set of steps where steps are allocated one after another. 
Process can have an unlimited amount of steps.

Process and each step accept input values and return back the result of work. 
Process/step input and output is a list of key/value string pairs.

All steps of the same process use the same instance of data storage – context (so that each step is able to access results of previous steps and process input).

## Description

Framework provides three basic interface _Recipe_, _Context_, and _Step_. 

_Context_ object is available to all steps inside one recipe. 
One should provde public methods for getting input data and results, and method for adding step result to common context results set.
**Recipe** has realisation of this interface - _Array_context_, which holds data in simple arrays.

_Step_ represents particular operation within Recept. Them main method of each step is _do_. It accepts current _Context_ and _Closure_ link to the next step.
This method manipulates with _Context_ and pass it to the next step. Framework already has three build-in math operations: sum, multiple, and divide.

_Recipe_ takes the set of _Steps_ and executes them in given order, returning the _Context_ with all intermediate results.
When creating new _Recipe_ we should provide _Context_. To add new steps to recipe _addStep_ method exists. 
To run execution process one should use _cook_, which returns final _Context_.
The current realisation is _WaterfallRecipe_, provides step-by-step execution in order of adding each step.

## Usage

You can use existing class _PhpRecipeFactory_. It accepts .php files with arrays and generates _WaterfallRecipe_ based on it.

```php
$recipeFactory = new PhpRecipeFactory('recipes/simple.php');
$recipe = $recipeFactory->make();
```

Example of simple.php file
```php
<?php

return [
    'inputs' => [
        'a' => 4,
        'b' => 5,
        'x' => 10,
    ],
    'steps' => [
        [\Rzhukovskiy\Recipe\Steps\Multiply::class, ['input', 'a'], ['input', 'x']],
        [\Rzhukovskiy\Recipe\Steps\Sum::class, ['result', 0], ['input', 'x']],
        [\Rzhukovskiy\Recipe\Steps\Divide::class, ['result', 1], ['input', 'b']],
        [\Rzhukovskiy\Recipe\Steps\Sum::class, ['result', 2], [6]],
    ],
];
```
It should provide two arrays: 'inputs' - key-value array of inputs. And 'steps'. Each row of 'steps' array consist of className of _Step_ object. And aray of args for this step.
You can use 'input' and 'result' keys to take values from input or result sets of _Context_ accordingly. If this key is ommited the value itself will be used.

So this example means:
take "a" = 4, "b" = 5, "x" = 10 as inputs and calculate formula (a*x + x)/b + 6. The result is 16. The final result _Context_ has results for each step.

Final code for this eample:
```php
$recipeFactory = new PhpRecipeFactory('recipes/simple.php');
$recipe = $recipeFactory->make();
$finalContext = $recipe->cook();

echo 'Recipe result: ', $finalContext->getLastResult();
```

Or recipe object can be created manually:
```php
$context = new ArrayContext([
    'a' => 7,
    'x' => 10,
    'b' => 100,
]);
$recipe = new WaterfallRecipe($context);
$recipe->addStep(new Multiply([['input', 'a'], ['input', 'x']]));
$recipe->addStep(new Sum([['input', 'b'], ['result', 0]]));
$recipe->addStep(new Devide([['result', 1]]));
$finalContext = $recipe->cook();
```
