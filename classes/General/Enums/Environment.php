<?php

declare(strict_types=1);

namespace General\Enums;

use Cerbero\Enum\Concerns\Enumerates;

enum Environment: string
{
    use Enumerates;

    case Development = 'dev';
    case Staging = 'staging';
    case Production = 'production';

    /**
     * Returns the default environment
     */
    public static function default(): self
    {
        return self::Production;
    }

    /**
     * Returns a pretty version of the group name.
     */
    public function pretty(): string
    {
        return match ($this) {
            self::Development => 'Development',
            self::Staging => 'Staging',
            self::Production => 'Production',
        };
    }

    /**
     * Returns a pretty version of the group name.
     */
    public function short(): string
    {
        return match ($this) {
            self::Development => 'Dev',
            self::Staging => 'Staging',
            self::Production => 'Prod',
        };
    }
}
