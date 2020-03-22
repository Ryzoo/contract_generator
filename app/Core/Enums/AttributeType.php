<?php


namespace App\Core\Enums;

use App\Core\Traits\EnumIterator;

class AttributeType {

  use EnumIterator;

  public const NUMBER = 0;

  public const TEXT = 1;

  public const SELECT = 2;

  public const ATTRIBUTE_GROUP = 3;

  public const DATE = 4;

  public const TIME = 5;

  public const BOOL = 6;

  public const AGGREGATE = 7;
}
