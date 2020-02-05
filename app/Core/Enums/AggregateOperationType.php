<?php


namespace App\Core\Enums;

use App\Core\Traits\EnumIterator;

class AggregateOperationType {

  use EnumIterator;

  public const ADD = 'add';

  public const SUBTRACT = 'subtract';

  public const MULTIPLY = 'multiply';

  public const DIVIDE = 'divide';
}
