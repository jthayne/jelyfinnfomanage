<?php

/**
 * The following instances of spl_autoload_register() allows the autoloading of classes, enums, and interfaces based on the following naming schemes:
 *    classes/<namespace>/class.<classname>.php (all lowercase)
 *    classes/<namespace>/int.i<interface>.php (all lowercase)
 *    classes/<namespace>/enum.<classname>.php (all lowercase)
 */

declare(strict_types=1);

spl_autoload_register(
    function ($className) {
        $namespaceParts = explode('\\', $className);

        $className = ltrim($className, '\\');
        $lastNsPos = strripos($className, '\\');
        $fileName = $className . '.php';
        if ($lastNsPos !== false && $lastNsPos > 0) {
            $fileName = $namespaceParts[array_key_last($namespaceParts)] . '.php';
        }

        array_pop($namespaceParts);
        $namespace = implode(DIRECTORY_SEPARATOR, $namespaceParts);

        $pathName = __DIR__ . DIRECTORY_SEPARATOR
            . '..' . DIRECTORY_SEPARATOR
            . 'classes' . DIRECTORY_SEPARATOR
            . $namespace . DIRECTORY_SEPARATOR
            . $fileName;

        if (file_exists($pathName) === true) {
            include_once $pathName;
            return true;
        }

        return false;
    },
);
