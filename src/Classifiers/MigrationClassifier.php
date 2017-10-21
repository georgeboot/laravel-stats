<?php

namespace Wnx\LaravelStats\Classifiers;

use Wnx\LaravelStats\ReflectionClass;

class MigrationClassifier extends Classifier
{
    public function getName()
    {
        return 'Migrations';
    }

    public function satisfies(ReflectionClass $class)
    {
        dump($class->getFileName());
        return $class->isSubclassOf(\Illuminate\Database\Migrations\Migration::class);
    }
}
