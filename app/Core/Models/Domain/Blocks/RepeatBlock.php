<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Enums\ConditionalType;
use App\Core\Helpers\AttributeResolver;
use App\Core\Helpers\MultiAttributeResolver;
use App\Core\Helpers\Parsers\ModelObjectToTextParser;
use App\Core\Helpers\PdfRenderer;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\Attributes\Attribute;
use Illuminate\Support\Collection;

class RepeatBlock extends TextBlock {

  private Attribute $repeatAttribute;
  private Contract $contract;
  private int $conditionalType;

  public function __construct() {
    parent::__construct();
    $this->initialize(BlockType::REPEAT_BLOCK);
  }

  protected function buildSettings() {
    $this->settings = [
      'repeatAttributeId' => NULL,
    ];
  }

  public function validateConditions(int $conditionalType, Collection $formElements, Contract $contract): bool{
    $this->conditionalType = $conditionalType;
    $this->formElements = $formElements;
    $this->contract = $contract;

    return true;
  }

  public function findVariable(Contract $contract): Collection {
    $variableArray = parent::findVariable($contract);

    if(isset($this->settings->repeatAttributeId))
      $variableArray->push([$this->id, $this->settings->repeatAttributeId]);

    return $variableArray->uniqueStrict('1');
  }

  protected function resolveAttributesInContent(Collection $formElements) {
    $attributeResolver = new AttributeResolver($formElements);
    $this->content['text'] = $attributeResolver->resolveText($this->content['text']);
    $this->repeatAttribute = $attributeResolver->getAttributeById($this->settings->repeatAttributeId ?? -1);
  }

  public function renderToHtml(Collection $attributes): string {
    $htmlString = parent::renderToHtml($attributes);
    return isset($this->repeatAttribute) ? $this->repeatContent($htmlString) : $htmlString;
  }

  private function repeatContent(string $content): string {
    $htmlString = '';
    $self = $this;
    $conditionalList = collect(collect($this->conditionals)
      ->where('conditionalType', ConditionalType::SHOW_ON)
      ->all());

    foreach (collect($this->repeatAttribute->value) as $key => $value){
      $isActive = $conditionalList
        ->every(static function ($element) use ($self) {
          return $self->isConditionalValidAndEqual(
            ModelObjectToTextParser::parse(json_decode($element->content, TRUE, 512, JSON_THROW_ON_ERROR)),
            TRUE, $key);
        });

      if($isActive) {
        $htmlString .= PdfRenderer::blockHtmlTemplate(
          MultiAttributeResolver::resolve($this->repeatAttribute, $content, $value)
        );
      }
    }




    return $htmlString;
  }
}
