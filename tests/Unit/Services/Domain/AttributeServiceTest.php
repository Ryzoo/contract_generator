<?php

namespace Tests\Unit\Services\Domain;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Enums\AttributeType;

class AttributeServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var \App\Repository\Domain\AttributeRepository
     */
    private $attributeRepository;

    public function setUp(): void {
        parent::setUp();
        $this->attributeRepository = $this->app->make('App\Repository\Domain\AttributeRepository');
    }

    public function testGetListOfAttributes() {
        $listOfAttributes = $this->attributeRepository->getListOfAttributes();
        $countOfExistAttributeType = count(AttributeType::getList());

        $this->assertEquals($countOfExistAttributeType, count($listOfAttributes));
    }
}
