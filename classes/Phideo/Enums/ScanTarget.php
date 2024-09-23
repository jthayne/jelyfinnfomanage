<?php

declare(strict_types=1);

namespace Phideo\Enums;

use Cerbero\Enum\Concerns\Enumerates;

enum ScanTarget
{
    use Enumerates;

    case GENRE;
    case TAG;
    case TITLE;
}
