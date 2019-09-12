<?php

namespace Tests\Unit\Services\Domain;

use App\Enums\ConditionalType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConditionalServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var \App\Repository\Domain\ConditionalRepository
     */
    private $conditionalRepository;

    public function setUp(): void {
        parent::setUp();
        $this->conditionalRepository = $this->app->make('App\Repository\Domain\ConditionalRepository');
    }

    public function testGetListOfConditionals() {
        $listOfConditional = $this->conditionalRepository->getListOfConditional();
        $countOfExistConditionalType = count(ConditionalType::getList());

        $this->assertEquals($countOfExistConditionalType, count($listOfConditional));
    }
}
