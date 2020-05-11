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

class ListBlock extends EmptyBlock {

  public function __construct() {
    parent::__construct();
    $this->initialize(BlockType::LIST_BLOCK);
  }

  protected function buildSettings(): void {
    $this->settings = [
      'enumeratorType' => EnumeratorListType::DOT,
    ];
  }

  public function renderToHtml(Collection $attributes, Attribute $repeatAttribute = NULL, $repeatValue = NULL): string {
    $this->resolveAttributesInContent($attributes, $repeatValue, $repeatValue);
    $htmlString = '';
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
