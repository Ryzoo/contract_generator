<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Enums\ConditionalType;
use App\Core\Helpers\AttributeResolver;
use App\Core\Helpers\BlockCounterResolver;
use App\Core\Helpers\MultiAttributeResolver;
use App\Core\Helpers\Parsers\ModelObjectToTextParser;
use App\Core\Helpers\PdfRenderer;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\Attributes\Attribute;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class RepeatBlock extends EmptyBlock {

  private ?Attribute $repeatAttribute;
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

  protected function validateContent():bool {
    Validator::validate($this->content,[
      'blocks' => 'nullable|array',
    ]);

    return true;
  }

  protected function buildContent() {
    $this->content['blocks'] = Block::getListFromString(json_encode($this->content['blocks'], JSON_THROW_ON_ERROR, 512));
  }

  public function validateConditions(int $conditionalType, Collection $formElements, Contract $contract, int $index = 0): bool{
    $this->conditionalType = $conditionalType;
    $this->formElements = $formElements;
    $this->contract = $contract;
    $this->isActive  = true;

    return true;
  }

  public function findVariable(Contract $contract): Collection{
    $variableArray = parent::findVariable($contract);

    if(isset($this->settings->repeatAttributeId)) {
      $variableArray->push([$this->id, $this->settings->repeatAttributeId]);
    }

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

  protected function resolveAttributesInContent(Collection $formElements, Attribute $repeatAttribute = null, $repeatValue = null) {
    $attributeResolver = new AttributeResolver($formElements);
    $this->repeatAttribute = $attributeResolver->getAttributeById($this->settings['repeatAttributeId'] ?? -1);

    $blockList = $this->content['blocks'];

    /** @var \App\Core\Models\Domain\Blocks\Block $block */
    foreach ($blockList as $block){
      $block->resolveAttributesInContent($formElements, $repeatAttribute, $repeatValue);
    }
  }

  public function renderToHtml(Collection $attributes, Attribute $repeatAttribute = null, $repeatValue = null): string {
    $htmlString = parent::renderToHtml($attributes, $repeatAttribute, $repeatValue);
    return isset($this->repeatAttribute) ? $this->repeatContent($htmlString, $attributes) : $htmlString;
  }

  private function repeatContent(string $htmlString, $attributes): string {
    $self = $this;
    $conditionalList = collect(collect($this->conditionals)
      ->where('conditionalType', ConditionalType::SHOW_ON)
      ->all());

    foreach (collect($this->repeatAttribute->value) as $key => $value){
      $isActive = $conditionalList
        ->every(static function ($element) use ($self, $key) {
          return $self->isConditionalValidAndEqual(
              ModelObjectToTextParser::parse(json_decode($element->content, TRUE, 512, JSON_THROW_ON_ERROR)),
              TRUE, $key);
          });

      if($isActive) {
        /** @var \App\Core\Models\Domain\Blocks\Block $block */
        foreach ($this->content['blocks'] as $block){
          $tempChild = clone $block;
          $tempChild->validateConditions($this->conditionalType, $this->formElements, $this->contract, $key);

          if($tempChild->isActive){
            $tempChild->resolveAttributesInContent($this->formElements, $this->repeatAttribute, $value);
            $htmlString .= PdfRenderer::blockHtmlTemplate($tempChild->renderToHtml($attributes));
          }
        }
      }
    }

    return $htmlString;
  }
}
