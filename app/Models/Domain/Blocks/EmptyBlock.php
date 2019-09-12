<?php


namespace App\Models\Domain\Blocks;

use App\Enums\BlockType;
use App\Helpers\Validator;
use App\Models\Domain\Contract;
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

    protected function resolveAttributesInContent(array $attributes) {
        $blockList = $this->content["blocks"];

        /** @var \App\Models\Domain\Blocks\Block $block */
        foreach ($blockList as $block){
            $block->resolveAttributesInContent($attributes);
        }
    }

    public function findVariable(Contract $contract): Collection{
        $variableArray = parent::findVariable($contract);

        /** @var \App\Models\Domain\Blocks\Block $block */
        foreach ($this->content["blocks"] as $block){
            $variableArray->push($block->findVariable($contract));
        }

        return $variableArray->uniqueStrict("1");
    }

    public function getBlockCollection(Collection $blockCollection): Collection{
        $blockCollection = parent::getBlockCollection($blockCollection);

        /** @var \App\Models\Domain\Blocks\Block $block */
        foreach ($this->content["blocks"] as $block){
            $blockCollection = $block->getBlockCollection($blockCollection);
        }

        return $blockCollection;
    }

    public function renderToHtml(array $attributes): string {
        $htmlString = parent::renderToHtml($attributes);
        $blockList = $this->content["blocks"];

        /** @var \App\Models\Domain\Blocks\Block $block */
        foreach ($blockList as $block){
            $htmlString .= $block->renderToHtml($attributes);
            $htmlString .= "<br/>";
        }

        return $htmlString;
    }

}
