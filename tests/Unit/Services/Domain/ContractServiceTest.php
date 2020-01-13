<?php

namespace Tests\Unit\Services\Domain;

use App\Core\Models\Domain\Contract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContractServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var \App\Core\Services\Domain\ContractService
     */
    private $contractService;

    public function setUp(): void {
        parent::setUp();
        $this->contractService = $this->app->make('App\Core\Services\Domain\ContractService');
    }

    public function testAddContract() {
        $defaultData = collect($this->getDefaultDataForContract())->except('categories');

        $notSavedContract = new Contract();
        $notSavedContract->fill( collect($defaultData)->except('categories')->toArray() );

        $savedContract = $this->contractService->createContract($notSavedContract);

        $this->assertNotNull( count($savedContract->blocks));
        $this->assertNotNull( count($savedContract->attributesList));
        $this->assertNotNull( count($savedContract->settings));
    }

    public function testRemoveContract(){
        $defaultData = $this->getDefaultDataForContract();

        $notSavedContract = new Contract();
        $notSavedContract->fill( collect($defaultData)->except('categories')->toArray() );
        $savedContract = $this->contractService->createContract($notSavedContract);

        $this->assertEquals(1,Contract::all()->count());
        $this->contractService->removeContractById([$savedContract->id]);
        $this->assertEquals(0,Contract::all()->count());
    }

    public function testRemoveContractThrowExceptionWhenNotFound(){
        $this->expectException(\Exception::class);

        $this->contractService->removeContractById([100]);
    }

    private function getDefaultDataForContract(){
        $jsonDataFromTestFile = file_get_contents(app_path("Core/test.json"));
        return json_decode($jsonDataFromTestFile, true);
    }

}
