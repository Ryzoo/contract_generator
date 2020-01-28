<?php

namespace Tests\Unit\Services\Domain;

use App\Core\Enums\ConditionalType;
use App\Core\Repository\ConditionalRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConditionalServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var ConditionalRepository
     */
    private $conditionalRepository;

    public function setUp(): void {
        parent::setUp();
        $this->conditionalRepository = $this->app->make(ConditionalRepository::class);
    }

    public function testGetListOfConditionals() {
        $listOfConditional = $this->conditionalRepository->getListOfConditional();
        $countOfExistConditionalType = count(ConditionalType::getList());

        $this->assertEquals($countOfExistConditionalType, count($listOfConditional));
    }
}
