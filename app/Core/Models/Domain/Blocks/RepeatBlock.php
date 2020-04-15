<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Helpers\AttributeResolver;
use App\Core\Helpers\MultiAttributeResolver;
use App\Core\Helpers\PdfRenderer;
use App\Core\Models\Database\Contract;
use Illuminate\Support\Collection;

class RepeatBlock extends TextBlock {

  /**
   * @var \App\Core\Models\Domain\Attributes\Attribute $repeatAttribute
   */
  private $repeatAttribute;

  public function __construct() {
    parent::__construct();
    $this->initialize(BlockType::REPEAT_BLOCK);
  }

  protected function buildSettings() {
    $this->settings = [
      'repeatAttributeId' => NULL,
    ];
  }

  public function findVariable(Contract $contract): Collection {
    $variableArray = parent::findVariable($contract);

    if(isset($this->settings->repeatAttributeId))
      $variableArray->push([$this->id, $this->settings->repeatAttributeId]);

    return $variableArray->uniqueStrict('1');
  }

  protected function resolveAttributesInContent(Collection $formElements) {
    parent::resolveAttributesInContent($formElements);
    $attributeResolver = new AttributeResolver($formElements);
    $this->repeatAttribute = $attributeResolver->getAttributeById($this->settings->repeatAttributeId ?? -1);
  }

  public function renderToHtml(Collection $attributes): string {
    $htmlString = parent::renderToHtml($attributes);
    return isset($this->repeatAttribute) ? $this->repeatContent($htmlString) : $htmlString;
  }

  private function repeatContent(string $content): string {
    $htmlString = '';
    foreach (collect($this->repeatAttribute->value) as $value){
      $htmlString .= PdfRenderer::blockHtmlTemplate(
        MultiAttributeResolver::resolve($this->repeatAttribute, $content, $value)
      );
    }
    return $htmlString;
  }
}
