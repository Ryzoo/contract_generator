<?php


namespace App\Models\Domain\Blocks;


use App\Contracts\Domain\IBlock;
use App\Enums\BlockType;
use App\Helpers\Response;
use App\Helpers\Validator;
use Intervention\Image\Exception\NotFoundException;

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

    public static function getBlockByType(int $blockType):IBlock {
        switch ($blockType)
        {
            case BlockType::TEXT_BLOCK:
                return new TextBlock();
            case BlockType::EMPTY_BLOCK:
                return new EmptyBlock();
            case BlockType::PAGE_DIVIDE_BLOCK:
                return new PageDivideBlock();
        }

        throw new NotFoundException("Block {$blockType} was not found");
    }

    public static function validate($value):bool {
        Validator::validate($value,[
            "id" => "required|integer",
            "content" => "required|json",
            "conditional" => "required|json",
            "settings" => "required|json",
        ]);

        return true;
    }

    public static function getListFromString(string $value): array {
        $arrayOfBlocks = json_decode($value);
        $returnedArray = [];

        if(!is_array($arrayOfBlocks))
            Response::error(_('custom.array.attributes'));

        foreach ($arrayOfBlocks as $block){
            array_push($returnedArray, self::getFromString($block));
        }

        return $returnedArray;
    }

    public static function getFromString($value):IBlock {
        Block::validate($value);
        $block = self::getBlockByType($value["id"]);

        $block->blockType = $value["id"];
        $block->blockName = BlockType::getName($value["id"]);
        $block->settings = $value["settings"];
        $block->conditional = $value["conditional"];
        $block->content = $value["content"];

        return $block;
    }
}
