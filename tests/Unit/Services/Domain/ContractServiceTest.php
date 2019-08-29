<?php

namespace Tests\Unit\Services\Domain;

use App\Models\Domain\Contract;
use Tests\TestCase;

class ContractServiceTest extends TestCase {
    /***
     * @var \App\Services\Domain\ContractService
     */
    private $contractService;

    public function setUp(): void {
        parent::setUp();
        $this->contractService = $this->app->make('App\Services\Domain\ContractService');
    }

    public function testAddContract() {
        $notSavedContract = new Contract();
        $notSavedContract->fill( $this->getDefaultDataForContract() );

        $savedContract = $this->contractService->addContract($notSavedContract);

        $contractBlocks = $savedContract->blocks;
        $contractAttributesList = $savedContract->attributesList;
        $contractSettings = $savedContract->settings;

        $this->assertEquals(4, count($contractBlocks));
        $this->assertEquals(5, count($contractAttributesList));
        $this->assertEquals(0, count($contractSettings));
    }

    private function getDefaultDataForContract(){
        $jsonDataFromTestFile = file_get_contents(app_path("test.json"));
        return json_decode($jsonDataFromTestFile, true);
    }
}
