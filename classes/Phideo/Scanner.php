<?php

declare(strict_types=1);

namespace Phideo;

use Medoo\Medoo;
use Phideo\Enums\ScanTarget;
use RecursiveDirectoryIterator;

final class Scanner
{
    public function __construct(private readonly string $directory, private Medoo $database) {}

    public function scan(ScanTarget $target): array|null
    {
        if (is_dir($this->directory) === false) {
            var_dump($this->directory);
            exit;
        }

        $data = [];

        $it = new RecursiveDirectoryIterator($this->directory);
        $it->rewind();
        while ($it->valid() === true) {
            if ($it->isFile() === true) {
                $processor = new Processor($it->getRealPath());

                switch ($target) {
                case ScanTarget::GENRE:
                    $data = array_merge($data, $processor->getGenres());
                    break;
                case ScanTarget::TAG:
                    $data = array_merge($data, $processor->getTags());
                    break;
                case ScanTarget::TITLE:
                    $data = array_merge($data, $processor->getTitle());
                }

                unset($processor);
            }

            $it->next();
        }

        return $data;
    }
}
