<?php
namespace App\Core\Models\Domain;

use Illuminate\Support\Collection;

class Statistic {
  /**
   * @var Collection
   */
  public $data;

  /**
   * @var ?string
   */
  public $lastTime;

  public function __construct(Collection $data, ?string $lastTime) {
    $this->data = $data;
    $this->lastTime = $lastTime;
  }
}
