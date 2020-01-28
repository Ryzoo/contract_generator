<?php

namespace Tests\Unit\Services\Domain;

use App\Core\Repository\AttributeRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Core\Enums\AttributeType;

class AttributeServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var AttributeRepository
     */
    private $attributeRepository;

    public function setUp(): void {
        parent::setUp();
        $this->attributeRepository = $this->app->make(AttributeRepository::class);
    }

    public function testGetListOfAttributes() {
        $listOfAttributes = $this->attributeRepository->getListOfAttributes();
        $countOfExistAttributeType = count(AttributeType::getList());

        $this->assertEquals($countOfExistAttributeType, count($listOfAttributes));
    }
}
