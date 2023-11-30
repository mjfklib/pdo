<?php

declare(strict_types=1);

namespace mjfklib\PDO;

use mjfklib\Container\ArrayValue;
use mjfklib\Container\Env;

class PDOConfig
{
    public const PDO_DSN = 'PDO_DSN';
    public const PDO_USER = 'PDO_USER';
    public const PDO_PASS = 'PDO_PASS';
    public const PDO_OPTIONS = 'PDO_OPTIONS';


    /**
     * @param Env $env
     * @return self
     */
    public static function create(Env $env): self
    {
        return new self(
            $env[static::PDO_DSN] ?? '',
            $env[static::PDO_USER] ?? null,
            $env[static::PDO_PASS] ?? null,
            ArrayValue::getArrayNull(
                [static::PDO_OPTIONS => $env[static::PDO_OPTIONS] ?? null],
                static::PDO_OPTIONS
            )
        );
    }


    /**
     * @param string $dsn
     * @param string|null $username
     * @param string|null $password
     * @param mixed[]|null $options
     */
    public function __construct(
        public string $dsn,
        public string|null $username,
        public string|null $password,
        public array|null $options
    ) {
    }
}
