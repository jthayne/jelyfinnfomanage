<?php

declare(strict_types=1);

use Phideo\Enums\ScanTarget;
use Phideo\Scanner;

$db = require_once '../bootstrap/bootstrap.php';

$directory = __DIR__ . DIRECTORY_SEPARATOR . '../samples';

$scanner = new Scanner($directory, $db);
$results = $scanner->scan(ScanTarget::TITLE);
print_r($results);

$results = $scanner->scan(ScanTarget::TAG);
print_r($results);

$results = $scanner->scan(ScanTarget::GENRE);
print_r($results);
//
//echo 'Details(s): ' . PHP_EOL;
//foreach ($this->movieName as $title) {
//    echo '  ' . $title . PHP_EOL;
//}
//
//echo 'Tag(s): ' . PHP_EOL;
//foreach ($this->tags as $tag) {
//    echo '  ' . $tag . PHP_EOL;
//}
//
//echo PHP_EOL;

//$it = new RecursiveDirectoryIterator($directory);
//
//$it->rewind();
//while ($it->valid() === true) {
//    if ($it->isFile() === true) {
//        echo 'Name:      ' . $it->getFilename() . PHP_EOL;
//        echo 'Extension: ' . $it->getExtension() . PHP_EOL;
//        echo 'Path:      ' . $it->getPath() . PHP_EOL;
//        echo 'Path:      ' . $it->getRealPath() . PHP_EOL;
//
//        $processor = new Processor($it->getRealPath());
//        $processor->echoDetails();
//
//        echo PHP_EOL;
//    }
//
//    $it->next();
//}
