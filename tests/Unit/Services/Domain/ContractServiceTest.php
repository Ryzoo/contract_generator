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

    /***
     * @var \App\Core\Repository\Domain\ContractRepository
     */
    private $contractRepository;

    public function setUp(): void {
        parent::setUp();
        $this->contractService = $this->app->make('App\Core\Services\Domain\ContractService');
        $this->contractRepository = $this->app->make('App\Core\Repository\Domain\ContractRepository');
    }

    public function testAddContract() {
        $notSavedContract = new Contract();
        $notSavedContract->fill( $this->getDefaultDataForContract() );

        $savedContract = $this->contractService->addContract($notSavedContract);

        $contractBlocks = $savedContract->blocks;
        $contractAttributesList = $savedContract->attributesList;
        $contractSettings = $savedContract->settings;

        $this->assertNotNull( count($contractBlocks));
        $this->assertNotNull( count($contractAttributesList));
        $this->assertNotNull( count($contractSettings));
    }

    public function testGetAllContract(){
        $notSavedContract = new Contract();
        $notSavedContract->fill( $this->getDefaultDataForContract() );
        $this->contractService->addContract($notSavedContract);

        $allContract = $this->contractRepository->getContractCollection();

        $this->assertEquals(1,$allContract->count());
    }

    public function testRemoveContract(){
        $notSavedContract = new Contract();
        $notSavedContract->fill( $this->getDefaultDataForContract() );
        $savedContract = $this->contractService->addContract($notSavedContract);

        $allContract = $this->contractRepository->getContractCollection();

        $this->assertEquals(1,$allContract->count());
        $this->contractService->removeContractById([$savedContract->id]);

        $allContract = $this->contractRepository->getContractCollection();
        $this->assertEquals(0,$allContract->count());
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
