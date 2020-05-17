<?php

namespace Tests;

use App\Core\Services\Contract\ContractService;
use App\Core\Services\Contract\FormService;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\ContractBuilder\ConditionalsBuilder;
use Tests\ContractBuilder\ContractBuilder;

abstract class TestCase extends BaseTestCase {
  use CreatesApplication;
  protected ContractBuilder $contractBuilder;
  protected ConditionalsBuilder $conditionalsBuilder;

  public function setUp(): void {
    parent::setUp();
    $this->contractBuilder = new ContractBuilder($this->app->make(ContractService::class), $this->app->make(FormService::class));
    $this->conditionalsBuilder = new ConditionalsBuilder();
  }

  protected function builder() {
    return $this->contractBuilder->make();
  }

  protected function conditionals() {
    return $this->conditionalsBuilder->make();
  }
}
