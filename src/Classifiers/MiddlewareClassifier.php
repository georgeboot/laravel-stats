<?php

namespace Wnx\LaravelStats\Classifiers;

use Wnx\LaravelStats\ReflectionClass;

class MiddlewareClassifier extends Classifier
{
    public function getName()
    {
        return 'Middlewares';
    }

    public function satisfies(ReflectionClass $class)
    {
        return false; // Lumen

        $kernel = app(\Illuminate\Contracts\Http\Kernel::class);

        if ($kernel->hasMiddleware($class->getName())) {
            return true;
        }

        $router = app('router');

        return collect($router->getMiddleware())
            ->merge($router->getMiddlewareGroups())
            ->flatten()
            ->contains($class->getName());
    }
}
