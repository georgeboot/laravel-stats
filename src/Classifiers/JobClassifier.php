<?php

namespace Wnx\LaravelStats\Classifiers;

use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;
use Wnx\LaravelStats\ReflectionClass;

class JobClassifier extends Classifier
{
    public function getName()
    {
        return 'Jobs';
    }

    public function satisfies(ReflectionClass $class)
    {
        if (app() instanceof LumenApplication) {
            return $class->hasMethod('handle');
        }
        
        return $class->usesTrait(\Illuminate\Foundation\Bus\Dispatchable::class);
    }
}
