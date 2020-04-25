<?php
namespace App\Core\Models\Domain;

use Illuminate\Support\Collection;

class Statistic {
  public Collection $data;
  public ?string $lastTime;

  public function __construct(Collection $data, ?string $lastTime) {
    $this->data = $data;
    $this->lastTime = $lastTime;
  }
}
