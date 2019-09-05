<?php

namespace Tests\Unit\Services\Domain;

use App\Enums\BlockType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlockServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var \App\Services\Domain\BlockService
     */
    private $blockService;

    public function setUp(): void {
        parent::setUp();
        $this->blockService = $this->app->make('App\Services\Domain\BlockService');
    }

    public function testGetListOfBlocks() {
        $listOfBlocks = $this->blockService->getListOfBlocks();
        $countOfExistBlocksType = count(BlockType::getList());

        $this->assertEquals($countOfExistBlocksType, count($listOfBlocks));
    }
}
