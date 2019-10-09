<?php


namespace App\Enums;

use App\Traits\EnumIterator;

class AvailableRenderActionsHook {
    use EnumIterator;

    public const BEFORE_FORM_RENDER = 0;
    public const FORM_RENDER = 1;
    public const BEFORE_FORM_END = 2;
    public const AFTER_FORM_END = 3;
}
