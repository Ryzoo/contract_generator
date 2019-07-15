<?php


namespace App\Models\Domain\Blocks;


use App\Contracts\Domain\IBlock;
use App\Enums\BlockType;

abstract class Block implements IBlock {
    /**
     * @var int
     */
    public $blockType;
    /**
     * @var string
     */
    public $blockName;

    /**
     * @var array
     */
    public $settings;

    /**
     * @var array
     */
    public $conditionals;

    /**
     * @var array
     */
    public $content;

    protected function initialize(int $blockType){
        $this->blockType = $blockType;
        $this->blockName = BlockType::getName($blockType);
        $this->settings = [];
        $this->content = [];
        $this->conditionals = [];
        $this->buildObject();
    }

    protected function buildObject(){
        $this->buildSettings();
        $this->buildContent();
        $this->buildConditionals();
    }

    protected abstract function buildSettings();
    protected abstract function buildContent();
    protected abstract function buildConditionals();
}