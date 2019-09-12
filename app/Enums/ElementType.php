<?php


namespace App\Enums;


use App\Traits\EnumIterator;

class ElementType {
    use EnumIterator;

    public const PAGE_BRAKE = 0;
    public const ATTRIBUTE = 1;
}
