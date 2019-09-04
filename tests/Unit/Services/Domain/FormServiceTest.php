<?php

namespace Tests\Unit\Services\Domain;

use App\Models\Domain\Contract;
use Tests\TestCase;

class FormServiceTest extends TestCase {
    /***
     * @var \App\Services\Domain\FormService
     */
    private $formService;
    /***
     * @var \App\Services\Domain\ContractService
     */
    private $contractService;

    public function setUp(): void {
        parent::setUp();
        $this->formService = $this->app->make('App\Services\Domain\FormService');
        $this->contractService = $this->app->make('App\Services\Domain\ContractService');
    }

    public function testGetContractFormForRender() {
        $savedContract = $this->getTestContract();

        $contractCollection = $this->formService->getContractFormForRender($savedContract);

        $this->assertEquals(5, $contractCollection->count());
    }

    private function getTestContract(): Contract{
        $notSavedContract = new Contract();
        $notSavedContract->fill( $this->getDefaultDataForContract() );

        $savedContract = $this->contractService->addContract($notSavedContract);

        return $savedContract;
    }

    private function getDefaultDataForContract(){
        $jsonDataFromTestFile = file_get_contents(app_path("test.json"));
        return json_decode($jsonDataFromTestFile, true);
    }
}
