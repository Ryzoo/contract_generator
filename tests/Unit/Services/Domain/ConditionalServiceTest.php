<?php

namespace Tests\Unit\Services\Domain;

use App\Enums\ConditionalType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConditionalServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var \App\Services\Domain\ConditionalService
     */
    private $conditionalService;

    public function setUp(): void {
        parent::setUp();
        $this->conditionalService = $this->app->make('App\Services\Domain\ConditionalService');
    }

    public function testGetListOfConditionals() {
        $listOfConditional = $this->conditionalService->getListOfConditional();
        $countOfExistConditionalType = count(ConditionalType::getList());

        $this->assertEquals($countOfExistConditionalType, count($listOfConditional));
    }
}
