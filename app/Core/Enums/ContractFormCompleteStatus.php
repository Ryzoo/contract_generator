<?php


namespace App\Core\Enums;

use App\Core\Traits\EnumIterator;

class ContractFormCompleteStatus {
    use EnumIterator;

    public const NEW = '0';
    public const PENDING = '1';
    public const AVAILABLE = '2';
    public const DELIVERED = '3';
    public const ERROR = '4';
    public const WAIT_FOR_ACTION = '5';
}
