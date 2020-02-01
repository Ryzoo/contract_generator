<?php

namespace Tests\Unit\Services\Domain;

use App\Core\Enums\BlockType;
use App\Core\Repository\BlockRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlockServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var BlockRepository
     */
    private $blockRepository;

    public function setUp(): void {
        parent::setUp();
        $this->blockRepository = $this->app->make(BlockRepository::class);
    }

    public function testGetListOfBlocks() {
        $listOfBlocks = $this->blockRepository->getListOfBlocks();
        $countOfExistBlocksType = count(BlockType::getList());

        $this->assertEquals($countOfExistBlocksType, count($listOfBlocks));
    }
}
