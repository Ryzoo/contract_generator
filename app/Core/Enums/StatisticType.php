<?php


namespace App\Core\Enums;


use App\Core\Traits\EnumIterator;

class StatisticType {

  use EnumIterator;

  public const SUBMISSIONS = 0;

  public const REGISTRATIONS = 1;

  public const NEW_CONTRACTS = 2;
}
