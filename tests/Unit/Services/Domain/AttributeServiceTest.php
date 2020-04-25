<?php

namespace Tests\Unit\Services\Domain;

use App\Core\Repository\AttributeRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Core\Enums\AttributeType;

class AttributeServiceTest extends TestCase {
    use RefreshDatabase;

    private AttributeRepository $attributeRepository;

    public function setUp(): void {
        parent::setUp();
        $this->attributeRepository = $this->app->make(AttributeRepository::class);
    }

    public function testGetListOfAttributes(): void {
        $listOfAttributes = $this->attributeRepository->getListOfAttributes();
        $countOfExistAttributeType = count(AttributeType::getList());

        $this->assertCount($countOfExistAttributeType, $listOfAttributes);
    }
}
