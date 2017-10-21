<?php

namespace Wnx\LaravelStats\Classifiers;

use Illuminate\Routing\Router;
use Wnx\LaravelStats\ReflectionClass;

class ControllerClassifier extends Classifier
{
    public function getName()
    {
        return 'Controllers';
    }

    public function satisfies(ReflectionClass $class)
    {
        return collect(app('router')->getRoutes())
            ->reject(function ($route) {
                return $route->getActionName() === 'Closure';
            })
            ->map(function ($route) {
                return get_class($route->getController());
            })
            ->unique()
            ->contains($class->getName());
    }
}
