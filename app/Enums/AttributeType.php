<?php

namespace App\Enums;

enum AttributeType: int
{
    use BaseEnum;

    case SELECT_BOX = 1;
    case COLORS = 2;
}
