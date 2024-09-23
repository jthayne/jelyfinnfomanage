<?php

declare(strict_types=1);

use Phideo\Processor;

require_once 'bootstrap/bootstrap.php';
$processor = new Processor('samples/movie_a.nfo');
dir('.');

$directory = 'samples';
$it = new RecursiveDirectoryIterator($directory);

$it->rewind();
while ($it->valid() === true) {
    if ($it->isFile() === true) {
        echo 'Name:      ' . $it->getFilename() . PHP_EOL;
        echo 'Extension: ' . $it->getExtension() . PHP_EOL;
        echo 'Path:      ' . $it->getPath() . PHP_EOL;
        echo 'Path:      ' . $it->getRealPath() . PHP_EOL;

        $processor = new Processor($it->getRealPath());
        $processor->echoDetails();

        echo PHP_EOL;
    }

    $it->next();
}
