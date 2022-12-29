<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\Attributes\Attribute;
use App\Core\Models\Domain\FormElements\PageDividerFormElement;
use Illuminate\Support\Collection;

class PageDivideBlock extends Block {

    public function __construct() {
        $this->initialize(BlockType::PAGE_DIVIDE_BLOCK);
    }

    protected function buildSettings():void {
        $this->settings = [
            'availableLevel' => 0,
            'isBreaker' => false,
        ];
    }

    protected function buildContent():void {}

    protected function validateContent(): bool {
        return true;
    }

    protected function resolveAttributesInContent(Collection $formElements, Attribute $repeatAttribute = null, $repeatValue = null):void {}

    public function renderToHtml(Collection $attributes, Attribute $repeatAttribute = null, $repeatValue = null): string {
        $htmlString = parent::renderToHtml($attributes, $repeatAttribute, $repeatValue);
        return (bool)$this->settings['isBreaker'] ? $htmlString . '<div class="page-break"></div>' : $htmlString;
    }

    public function getFormElements(Contract $contract): Collection{
        $formElements = collect();
        $formElements->push( new PageDividerFormElement($this->id, $this->blockName) );
        return $formElements;
    }
}
