<?php

namespace Tests\Unit\Services\Domain;

use App\Contracts\Domain\IAttribute;
use App\Models\Domain\Contract;
use Illuminate\Support\Collection;
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

        $this->assertInstanceOf(Collection::class, $contractCollection);
        $this->assertEquals(5, $contractCollection->count());

        foreach ($contractCollection as $formInput){
            $this->assertNotNull($formInput->attribute);
            $this->assertInstanceOf(IAttribute::class, $formInput->attribute);

            $attribute = $formInput->attribute;

            $this->assertIsArray($attribute->conditionals);
        }

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
