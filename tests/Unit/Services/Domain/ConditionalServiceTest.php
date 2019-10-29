<?php

namespace Tests\Unit\Services\Domain;

use App\Core\Enums\ConditionalType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConditionalServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var \App\Core\Repository\Domain\ConditionalRepository
     */
    private $conditionalRepository;

    public function setUp(): void {
        parent::setUp();
        $this->conditionalRepository = $this->app->make('App\Core\Repository\Domain\ConditionalRepository');
    }

    public function testGetListOfConditionals() {
        $listOfConditional = $this->conditionalRepository->getListOfConditional();
        $countOfExistConditionalType = count(ConditionalType::getList());

        $this->assertEquals($countOfExistConditionalType, count($listOfConditional));
    }
}
