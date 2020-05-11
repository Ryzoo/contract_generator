<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Enums\EnumeratorListType;
use App\Core\Helpers\BlockCounterResolver;
use App\Core\Helpers\PdfRenderer;
use App\Core\Models\Domain\Attributes\Attribute;
use Illuminate\Support\Facades\Validator;
use App\Core\Models\Database\Contract;
use Illuminate\Support\Collection;

class ListBlock extends Block {

  public function __construct() {
    $this->initialize(BlockType::LIST_BLOCK);
  }

  protected function buildSettings(): void {
    $this->settings = [
      'enumeratorType' => EnumeratorListType::DOT,
    ];
  }

  protected function validateContent(): bool {
    Validator::validate($this->content, [
      'blocks' => 'nullable|array',
    ]);

    return TRUE;
  }

  protected function buildContent(): void {
    $this->content['blocks'] = Block::getListFromString(json_encode($this->content['blocks'], JSON_THROW_ON_ERROR, 512));
  }

  protected function resolveAttributesInContent(Collection $formElements, Attribute $repeatAttribute = NULL, $repeatValue = NULL): void {
    $blockList = $this->content['blocks'];

    /** @var \App\Core\Models\Domain\Blocks\Block $block */
    foreach ($blockList as $block) {
      $block->resolveAttributesInContent($formElements, $repeatAttribute, $repeatValue);
    }
  }

  public function findVariable(Contract $contract): Collection {
    $variableArray = parent::findVariable($contract);

    /** @var \App\Core\Models\Domain\Blocks\Block $block */
    foreach ($this->content['blocks'] as $block) {
      $variableArray = $variableArray->merge($block->findVariable($contract));
    }

    return $variableArray;
  }

  public function counterResolve(string $matchString, int $countStart, Contract $contract): int {
    $countStart = parent::counterResolve($matchString, $countStart, $contract);
    $countStart = BlockCounterResolver::resolve($matchString, collect($this->content['blocks']), $contract, $countStart)['count'];
    return $countStart;
  }

  public function getBlockCollection(Collection $blockCollection): Collection {
    $blockCollection = parent::getBlockCollection($blockCollection);

    /** @var \App\Core\Models\Domain\Blocks\Block $block */
    foreach ($this->content['blocks'] as $block) {
      $blockCollection = $block->getBlockCollection($blockCollection);
    }

    return $blockCollection;
  }

  public function validateConditions(int $conditionalType, Collection $formElements, Contract $contract, int $index = 0): bool {
    $parentActive = parent::validateConditions($conditionalType, $formElements, $contract, $index);

    if ($parentActive) {
      /** @var \App\Core\Models\Domain\Blocks\Block $block */
      foreach ($this->content['blocks'] as $block) {
        $block->validateConditions($conditionalType, $formElements, $contract, $index);
      }

      $this->content['blocks'] = collect($this->content['blocks'])->where('isActive');
    }

    return $parentActive;
  }

  public function renderToHtml(Collection $attributes, Attribute $repeatAttribute = NULL, $repeatValue = NULL): string {
    $htmlString = parent::renderToHtml($attributes, $repeatAttribute, $repeatValue);
    $blockList = $this->content['blocks'];
    $htmlString .= $this->getListStartTag();

    /** @var \App\Core\Models\Domain\Blocks\Block $block */
    foreach ($blockList as $block) {
      $listItem = PdfRenderer::blockHtmlTemplate($block->renderToHtml($attributes, $repeatAttribute, $repeatValue));
      $isList = $block->blockType === BlockType::LIST_BLOCK;
      if($isList && $this->endswith($htmlString, '</li>')){
        $htmlString = substr($htmlString, 0, -5);
        $htmlString .= " {$listItem}</li>";
      }else{
        $htmlString .= "<li>{$listItem}</li>";
      }
    }

    $htmlString .= $this->getListEndTag();

    return $htmlString;
  }

  private function endswith($string, $test) {
    $strlen = strlen($string);
    $testlen = strlen($test);
    if ($testlen > $strlen) return false;
    return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
  }

  private function getListStartTag() {
    switch ((int)$this->settings['enumeratorType']){
      case EnumeratorListType::DOT:
        return '<ul style="list-style-type: disc;">';
      case EnumeratorListType::DECIMAL:
        return '<ol style="list-style-type: decimal;">';
      case EnumeratorListType::LOVER_ALPHA:
        return '<ol style="list-style-type: lower-alpha;">';
      case EnumeratorListType::UPPER_ROMAN:
        return '<ol style="list-style-type: upper-roman;">';
    }

    return '<ul>';
  }

  private function getListEndTag() {
    switch ((int)$this->settings['enumeratorType']){
      case EnumeratorListType::DOT:
        return '</ul>';
      case EnumeratorListType::DECIMAL:
      case EnumeratorListType::LOVER_ALPHA:
      case EnumeratorListType::UPPER_ROMAN:
        return '</ol>';
    }

    return '</ul>';
  }
}
