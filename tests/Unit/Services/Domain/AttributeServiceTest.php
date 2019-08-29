<?php

namespace Tests\Unit\Services\Domain;

use Tests\TestCase;
use App\Enums\AttributeType;

class AttributeServiceTest extends TestCase {
    /***
     * @var \App\Services\Domain\AttributeService
     */
    private $attributeService;

    public function setUp(): void {
        parent::setUp();
        $this->attributeService = $this->app->make('App\Services\Domain\AttributeService');
    }

    public function testGetListOfAttributes() {
        $listOfAttributes = $this->attributeService->getListOfAttributes();
        $countOfExistAttributeType = count(AttributeType::getList());

        $this->assertEquals($countOfExistAttributeType, count($listOfAttributes));
    }
}
