<?php


namespace App\Models\Domain\Blocks;

use App\Enums\BlockType;
use App\Helpers\Validator;
use Illuminate\Support\Collection;

class EmptyBlock extends Block {

    public function __construct() {
        $this->initialize(BlockType::EMPTY_BLOCK);
    }

    protected function buildSettings() {
        // TODO: Implement buildSettings() method.
    }

    protected function validateContent():bool {
        Validator::validate($this->content,[
            "blocks" => "nullable|array",
        ]);

        return true;
    }

    protected function buildContent() {
        $this->content["blocks"] = Block::getListFromString( json_encode($this->content["blocks"]) );
    }

    public function findVariable(Collection $variableArray): Collection{
        $variableArray = parent::findVariable($variableArray);

        foreach ($this->content["blocks"] as $block){
            $variableArray = $block->findVariable($variableArray);
        }

        return $variableArray->uniqueStrict();
    }
}
