<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\FormElements\PageDividerFormElement;
use Illuminate\Support\Collection;

class PageDivideBlock extends Block {

    public function __construct() {
        $this->initialize(BlockType::PAGE_DIVIDE_BLOCK);
    }

    protected function buildSettings() {
        $this->settings = [
            "availableLevel" => 0,
        ];
    }

    protected function buildContent() {
        // TODO: Implement buildContent() method.
    }

    protected function validateContent(): bool {
        return true;
    }

    protected function resolveAttributesInContent(Collection $formElements) {
        // TODO: Implement resolveAttributesInContent() method.
    }

    public function renderToHtml(Collection $attributes): string {
        $htmlString = parent::renderToHtml($attributes);
        return $htmlString . '<div class="page-break"></div>';
    }

    public function renderAdditionalCss(): string{
        $cssString = parent::renderAdditionalCss();
        return $cssString . ".page-break {
            page-break-after: always;
        }";
    }

    public function getFormElements(Contract $contract): Collection{
        $formElements = parent::getFormElements($contract);
        $formElements->push( new PageDividerFormElement($this->id) );
        return $formElements;
    }

}
