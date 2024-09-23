<?php

/** @noinspection GlobalVariableUsageInspection */

declare(strict_types=1);

namespace General;

/**
 * This class is designed to retrieve values from the $_ENV superglobal.
 */
final class Env
{
    /**
     * Gets the value for the specified environment variable. Returns null if the variable does not exist.
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public static function get(string $key): ?string
    {
        $key = strtoupper($key);

        if (isset($_ENV[$key]) === false) {
            return null;
        }

        return (string) $_ENV[$key];
    }
}
