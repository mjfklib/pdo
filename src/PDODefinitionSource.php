<?php

declare(strict_types=1);

namespace mjfklib\PDO;

use mjfklib\Container\DefinitionSource;
use mjfklib\Container\Env;

class PDODefinitionSource extends DefinitionSource
{
    /**
     * @inheritdoc
     */
    protected function createDefinitions(Env $env): array
    {
        return [
            PDOConfig::class => static::factory(
                [PDOConfig::class, 'create']
            ),
            \PDO::class => static::factory(
                [PDOFactory::class, 'create']
            ),
        ];
    }
}
