<?php

namespace Tests\Unit\Services\Domain;

use App\Enums\BlockType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlockServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var \App\Repository\Domain\BlockRepository
     */
    private $blockRepository;

    public function setUp(): void {
        parent::setUp();
        $this->blockRepository = $this->app->make('App\Repository\Domain\BlockRepository');
    }

    public function testGetListOfBlocks() {
        $listOfBlocks = $this->blockRepository->getListOfBlocks();
        $countOfExistBlocksType = count(BlockType::getList());

        $this->assertEquals($countOfExistBlocksType, count($listOfBlocks));
    }
}
