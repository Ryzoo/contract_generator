<?php


namespace App\Models\Domain\Blocks;

use App\Enums\BlockType;

class TextBlock extends Block {

    public function __construct() {
        $this->initialize(BlockType::TEXT_BLOCK);
    }

    protected function buildSettings() {
        // TODO: Implement buildSettings() method.
    }

    protected function buildContent() {
        // TODO: Implement buildContent() method.
    }

    protected function buildConditionals() {
        // TODO: Implement buildConditionals() method.
    }
}