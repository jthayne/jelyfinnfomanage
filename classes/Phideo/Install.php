<?php

declare(strict_types=1);

namespace Phideo;

use Medoo\Medoo;

final class Install
{
    public function __construct(private Medoo $database) {}

    public function init(): void
    {
        $this->setUpFiles();
        $this->setUpTags();
        $this->setUpGenres();
    }

    private function setUpTags(): void
    {
        $this->database->drop('tags');
        $this->database->create(
            'tags',
            [
                'tag' => ['VARCHAR(255)', 'UNIQUE'],
                'file' => ['INT', 'NOT NULL'],
            ],
        );
    }

    private function setUpFiles(): void
    {
        $this->database->drop('files');
        $this->database->create(
            'files',
            [
                'id' => ['INT', 'PRIMARY KEY'],
                'name' => ['VARCHAR(255)', 'NOT NULL'],
                'location' => ['VARCHAR(1024)', 'NOT NULL'],
            ],
        );
    }

    private function setUpGenres(): void
    {
        $this->database->drop('genres');
        $this->database->create(
            'genres',
            [
                'genre' => ['VARCHAR(255)', 'UNIQUE'],
                'file' => ['INT', 'NOT NULL'],
            ],
        );
    }
}
