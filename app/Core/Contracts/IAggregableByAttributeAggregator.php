<?php


namespace App\Core\Contracts;


interface IAggregableByAttributeAggregator {
  public function getOperationalValue(string $operation);
}
