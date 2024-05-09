<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Set\ValueObject\LevelSetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/Examples',
        __DIR__ . '/Tests',
        __DIR__ . '/src',
    ])
    ->withSkip([
        ClassPropertyAssignToConstructorPromotionRector::class
    ])
    // uncomment to reach your current PHP version
    // ->withPhpSets()
    ->withSets([
        LevelSetList::UP_TO_PHP_82,
    ]);
