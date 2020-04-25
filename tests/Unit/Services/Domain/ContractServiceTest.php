<?php

namespace Tests\Unit\Services\Domain;

use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\ContractSettings;
use App\Core\Services\Contract\ContractService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContractServiceTest extends TestCase {

  use RefreshDatabase;

  private ContractService $contractService;

  public function setUp(): void {
    parent::setUp();
    $this->contractService = $this->app->make(ContractService::class);
  }

  public function testAddContract(): void {
    $defaultData = $this->getDefaultDataForContract();
    $contractSettings = $defaultData['settings'];

    $notSavedContract = new Contract();
    $notSavedContract->fill(collect($defaultData)->except([
      'categories',
      'settings',
    ])->toArray());
    $notSavedContract->settings = ContractSettings::fromArray($contractSettings);
    $savedContract = $this->contractService->createContract($notSavedContract);

    $this->assertNotNull(count($savedContract->blocks));
    $this->assertNotNull(count($savedContract->attributesList));
    $this->assertIsObject($savedContract->settings);
  }

  public function testRemoveContract(): void {
    $defaultData = $this->getDefaultDataForContract();
    $contractSettings = $defaultData['settings'];

    $notSavedContract = new Contract();
    $notSavedContract->fill(collect($defaultData)->except([
      'categories',
      'settings',
    ])->toArray());
    $notSavedContract->settings = ContractSettings::fromArray($contractSettings);
    $savedContract = $this->contractService->createContract($notSavedContract);

    $this->assertEquals(1, Contract::all()->count());
    $this->contractService->removeContractById([$savedContract->id]);
    $this->assertEquals(0, Contract::all()->count());
  }

  public function testRemoveContractThrowExceptionWhenNotFound(): void {
    $this->expectException(\Exception::class);
    $this->contractService->removeContractById([100]);
  }

  private function getDefaultDataForContract() {
    $jsonDataFromTestFile = file_get_contents(app_path('Core/test.json'));
    return json_decode($jsonDataFromTestFile, TRUE, 512, JSON_THROW_ON_ERROR);
  }

}
