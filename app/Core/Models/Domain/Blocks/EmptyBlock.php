<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Helpers\BlockCounterResolver;
use App\Core\Helpers\PdfRenderer;
use Illuminate\Support\Facades\Validator;
use App\Core\Models\Database\Contract;
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
            'blocks' => 'nullable|array',
        ]);

        return true;
    }

    protected function buildContent() {
        $this->content['blocks'] = Block::getListFromString( json_encode($this->content["blocks"]) );
    }

    protected function resolveAttributesInContent(Collection $formElements) {
        $blockList = $this->content['blocks'];

        /** @var \App\Core\Models\Domain\Blocks\Block $block */
        foreach ($blockList as $block){
            $block->resolveAttributesInContent($formElements);
        }
    }

    public function findVariable(Contract $contract): Collection{
        $variableArray = parent::findVariable($contract);

        /** @var \App\Core\Models\Domain\Blocks\Block $block */
        foreach ($this->content['blocks'] as $block){
            $variableArray = $variableArray->merge($block->findVariable($contract));
        }

        return $variableArray->uniqueStrict('1');
    }

    public function counterResolve(string $matchString, int $countStart, Contract $contract): int {
      $countStart = parent::counterResolve($matchString, $countStart, $contract);
      $countStart = BlockCounterResolver::resolve($matchString, collect($this->content['blocks']), $contract, $countStart)['count'];
      return $countStart;
    }

    public function getBlockCollection(Collection $blockCollection): Collection{
        $blockCollection = parent::getBlockCollection($blockCollection);

        /** @var \App\Core\Models\Domain\Blocks\Block $block */
        foreach ($this->content['blocks'] as $block){
            $blockCollection = $block->getBlockCollection($blockCollection);
        }

        return $blockCollection;
    }

    public function validateConditions(int $conditionalType, Collection $formElements, Contract $contract): bool{
      $parentActive = parent::validateConditions($conditionalType, $formElements, $contract);

      if($parentActive){
        /** @var \App\Core\Models\Domain\Blocks\Block $block */
        foreach ($this->content['blocks'] as $block){
          $block->validateConditions($conditionalType, $formElements, $contract);
        }

        $this->content['blocks'] = collect($this->content['blocks'])->where('isActive');
      }

      return $parentActive;
    }

    public function renderToHtml(Collection $attributes): string {
        $htmlString = parent::renderToHtml($attributes);
        $blockList = $this->content['blocks'];

        /** @var \App\Core\Models\Domain\Blocks\Block $block */
        foreach ($blockList as $block){
            $htmlString .= PdfRenderer::blockHtmlTemplate($block->renderToHtml($attributes));
        }

        return $htmlString;
    }

}
