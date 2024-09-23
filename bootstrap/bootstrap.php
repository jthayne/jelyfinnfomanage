<?php

/**
 * This file sets up the necessary connections, etc. It should be included on all scripts.
 */

declare(strict_types=1);

use Dotenv\Dotenv;
use General\Enums\Environment;
use General\Env;
use Medoo\Medoo;

/**
 * Register The Auto Loader
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . '../vendor/autoload.php';

/**
 *--------------------------------------------------------------------------
 * Add environment variables
 *--------------------------------------------------------------------------
 */
$dotenv = Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '../config');
$dotenv->load();

/**
 *--------------------------------------------------------------------------
 * Set up app level items. Primarily class autoload
 *--------------------------------------------------------------------------
 */
require_once 'autoload.php';

/**
 *--------------------------------------------------------------------------
 * Verify the ENVIRONMENT value has been set to one of the allowed values
 *--------------------------------------------------------------------------
 */
$dotenv->required('ENVIRONMENT')->allowedValues(Environment::values());

/**
 *--------------------------------------------------------------------------
 * Setup SQLite connection and initialize database
 *--------------------------------------------------------------------------
 */
$init = false;
if (file_exists(Env::get('DATA_STORAGE') . 'phideo.db') === false) {
    $init = true;
}
$db = new Medoo([
    'type' => 'sqlite',
    'database' => Env::get('DATA_STORAGE') . 'phideo.db',
]);

if ($init === true) {
    $install = new \Phideo\Install($db);
    $install->init();
    unset($install);
}

return $db;
