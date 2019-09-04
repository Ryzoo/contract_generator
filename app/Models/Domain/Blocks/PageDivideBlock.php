<?php


namespace App\Models\Domain\Blocks;

use App\Enums\BlockType;

class PageDivideBlock extends Block {

    public function __construct() {
        $this->initialize(BlockType::PAGE_DIVIDE_BLOCK);
    }

    protected function buildSettings() {
        // TODO: Implement buildSettings() method.
    }

    protected function buildContent() {
        // TODO: Implement buildContent() method.
    }

    protected function validateContent(): bool {
        return true;
    }
}
