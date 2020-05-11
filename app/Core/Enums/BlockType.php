<?php


namespace App\Core\Enums;

use App\Core\Traits\EnumIterator;

class BlockType {

  use EnumIterator;

  public const TEXT_BLOCK = 0;

  public const EMPTY_BLOCK = 1;

  public const PAGE_DIVIDE_BLOCK = 2;

  public const REPEAT_BLOCK = 3;

  public const LIST_BLOCK = 4;

  public const LIST_ITEM_BLOCK = 5;
}
