<?php

namespace Tests\Unit\Services\Domain;

use App\Core\Enums\BlockType;
use App\Core\Repository\BlockRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlockServiceTest extends TestCase {
    use RefreshDatabase;

    private BlockRepository $blockRepository;

    public function setUp(): void {
        parent::setUp();
        $this->blockRepository = $this->app->make(BlockRepository::class);
    }

    public function testGetListOfBlocks(): void {
        $listOfBlocks = $this->blockRepository->getListOfBlocks();
        $countOfExistBlocksType = count(BlockType::getList());

        $this->assertCount($countOfExistBlocksType, $listOfBlocks);
    }
}
