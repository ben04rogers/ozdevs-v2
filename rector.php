<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    // Paths to refactor
    $rectorConfig->paths([
        __DIR__.'/app',
        __DIR__.'/tests',
    ]);

    $rectorConfig->sets([
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::CODING_STYLE,
        SetList::TYPE_DECLARATION,
        SetList::EARLY_RETURN,
        SetList::PRIVATIZATION,
        SetList::NAMING,
    ]);

    $rectorConfig->parallel();
    $rectorConfig->importNames();
};
