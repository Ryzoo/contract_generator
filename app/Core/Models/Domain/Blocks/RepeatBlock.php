<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Enums\ConditionalType;
use App\Core\Helpers\AttributeResolver;
use App\Core\Helpers\BlockCounterResolver;
use App\Core\Helpers\Parsers\ModelObjectToTextParser;
use App\Core\Helpers\PdfRenderer;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\Attributes\Attribute;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class RepeatBlock extends Block {

  private ?Attribute $repeatAttribute;
  private Contract $contract;
  private int $conditionalType;

  public function __construct() {
    $this->initialize(BlockType::REPEAT_BLOCK);
  }

  protected function buildSettings():void {
    $this->settings = [
      'repeatAttributeId' => NULL,
      'separator' => '',
    ];
  }

  protected function validateContent():bool {
    Validator::validate($this->content,[
      'blocks' => 'nullable|array',
    ]);

    return true;
  }

  protected function buildContent():void {
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

    if(isset($this->settings['repeatAttributeId'])) {
      $variableArray->push([$this->id, $this->settings['repeatAttributeId']]);
    }

    /** @var \App\Core\Models\Domain\Blocks\Block $block */
    foreach ($this->content['blocks'] as $block){
      $variableArray = $variableArray->merge($block->findVariable($contract));
    }

    return $variableArray;
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

  protected function resolveAttributesInContent(Collection $formElements, Attribute $repeatAttribute = null, $repeatValue = null):void {
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
    return $this->repeatContent($htmlString, $attributes);
  }

  private function repeatContent(string $htmlString, $attributes): string {
    $self = $this;
    $conditionalList = collect($this->conditionals);

    $valueCount = count($this->repeatAttribute->value);
    foreach (collect($this->repeatAttribute->value) as $key => $value){
      $isActive = false;
      if($conditionalList->count() === 0 ){
        $isActive = true;
      }else if(is_array($conditionalList[0])){
        $isActive = $conditionalList->first(static function($condition)use ($self, $key){
          $condition = collect($condition);
          return $condition->count() === 0 || $condition->every(static function ($element) use ($self, $key) {
            return $self->isConditionalValidAndEqual(
              ModelObjectToTextParser::parse(json_decode($element->content, TRUE, 512, JSON_THROW_ON_ERROR)),
              TRUE, $key);
          });
        });
      }else{
        $isActive = $conditionalList
          ->every(static function ($element) use ($self, $key) {
            return $self->isConditionalValidAndEqual(
              ModelObjectToTextParser::parse(json_decode($element->content, TRUE, 512, JSON_THROW_ON_ERROR)),
              TRUE, $key);
          });
      }

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

        if(($valueCount - 1) !== $key){
          $htmlString .= $this->getSeparator();
        }
      }
    }

    return $htmlString;
  }

  private function isSeparator():bool{
    return isset($this->settings['separator']) && $this->settings['separator'] !== '';
  }

  private function getSeparator():string{
    if(!$this->isSeparator()) {
      return '';
    }
    $separator = $this->settings['separator'];
    return "<p>$separator</p>";
  }
}
