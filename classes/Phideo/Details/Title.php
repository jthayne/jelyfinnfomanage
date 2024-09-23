<?php

declare(strict_types=1);

namespace Phideo\Details;

use Medoo\Medoo;

class Title
{
    public function __construct(private Medoo $database) {}

    public function add(string $title): int
    {
        $id = 0;

        return $id;
    }
}
