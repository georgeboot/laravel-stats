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
        // $kernel = app(\Illuminate\Contracts\Http\Kernel::class);
        //
        // if ($kernel->hasMiddleware($class->getName())) {
        //     return true;
        // }

        return collect([]);

        $router = app('router');

        return collect($router->getMiddleware())
            ->merge($router->getMiddlewareGroups())
            ->flatten()
            ->contains($class->getName());
    }
}
