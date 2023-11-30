<?php

declare(strict_types=1);

namespace mjfklib\PDO;

class PDOFactory
{
    public const DEFAULT_PDO_OPTIONS = [
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ];
    public const ATTR_DEFAULT_FETCH_MODE = 'PDO_ATTR_DEFAULT_FETCH_MODE';
    public const ATTR_EMULATE_PREPARES   = 'PDO_ATTR_EMULATE_PREPARES';
    public const ATTR_ERRMODE            = 'PDO_ATTR_ERRMODE';


    /**
     * @return \PDO
     */
    public function create(PDOConfig $config): \PDO
    {
        return new \PDO(
            dsn: $config->dsn,
            username: $config->username,
            password: $config->password,
            options: $this->getOptions($config->options ?? [])
        );
    }


    /**
     * @param mixed[] $options
     * @return mixed[]
     */
    private function getOptions(array $options): array
    {
        $opts = static::DEFAULT_PDO_OPTIONS;

        foreach ($options as $name => $value) {
            if (is_string($name) && defined($name)) {
                $name = constant($name);
                if (!(is_string($name) || is_int($name))) {
                    continue;
                }
            }

            if (is_string($value) && defined($value)) {
                $value = constant($value);
            }

            $opts[$name] = is_string($value)
                ? match (strtolower($value)) {
                    'true', 'on' => true,
                    'false', 'off' => false,
                    'null' => null,
                    default => $value
                }
                : $value;
        }

        return $opts;
    }
}
