<?php


namespace App\Models\Domain\Blocks;


use App\Contracts\Domain\IBlock;
use App\Enums\BlockType;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\Domain\Conditional\Conditional;
use Illuminate\Support\Collection;
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
     * @var int
     */
    public $id;
    /**
     * @var int
     */
    public $parentId;
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
        $this->id = 0;
        $this->parentId = 0;
        $this->content = [];
        $this->conditionals = [];
        $this->buildObject();
    }

    protected function buildObject(){
        $this->buildSettings();
    }
    protected function prepare() {
        $this->validateContent();
        $this->buildContent();
    }

    protected abstract function buildSettings();
    protected abstract function buildContent();
    protected abstract function validateContent():bool;
    protected abstract function resolveAttributesInContent(array $attributes);

    public static function getBlockByType(int $blockType):Block {
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
            "parentId" => "required|integer",
            "blockType" => "required|integer",
            "content" => "nullable",
            "conditionals" => "nullable|array",
            "settings" => "nullable",
        ]);

        return true;
    }

    public static function getListFromString(string $value): array {
        $arrayOfBlocks = json_decode($value);
        $returnedArray = [];

        if(!is_array($arrayOfBlocks))
            Response::error(_('custom.array.attributes'));

        foreach ($arrayOfBlocks as $block){
            array_push($returnedArray, self::getFromString((array)$block));
        }

        return $returnedArray;
    }

    public static function getFromString(array $value):Block {
        Block::validate($value);
        $block = self::getBlockByType($value["blockType"]);

        $block->id = $value["id"];
        $block->parentId = $value["parentId"];
        $block->blockType = $value["blockType"];
        $block->blockName = BlockType::getName($value["blockType"]);
        $block->settings = $value["settings"];
        $block->conditionals = Conditional::getListFromString(json_encode($value["conditionals"]));
        $block->content = (array) $value["content"];

        $block->prepare();

        return $block;
    }

    public function findVariable(Collection $variableArray): Collection{
        foreach ($this->conditionals as $conditional){
            $conditionalVariablesList = $conditional->getUsedVariable();
            foreach ($conditionalVariablesList as $arrayElement)
                $variableArray->push([$this->parentId, $arrayElement]);
        }

        return $variableArray->uniqueStrict("1");
    }

    public function getBlockCollection(Collection $blockCollection):Collection {
        $blockCollection->push($this);
        return $blockCollection;
    }

    public function renderToHtml(array $attributes):string{
        $this->resolveAttributesInContent($attributes);
        return "";
    }
}
