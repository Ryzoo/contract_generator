<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Helpers\AttributeResolver;
use App\Core\Helpers\CounterResolver;
use App\Core\Helpers\MultiAttributeResolver;
use App\Core\Models\Domain\Attributes\Attribute;
use Illuminate\Support\Facades\Validator;
use App\Core\Models\Database\Contract;
use Illuminate\Support\Collection;

class TextBlock extends Block {

  public function __construct() {
    $this->initialize(BlockType::TEXT_BLOCK);
  }

  protected function buildSettings():void {}

  protected function buildContent():void {
    if(!isset($this->content['text'])) {
      $this->content = [
        'text' => ''
      ];
    }
  }

  protected function validateContent(): bool {
    Validator::validate($this->content, [
      'text' => 'nullable|string',
    ]);

    $this->content['text'] = $this->content['text'] ?? '';

    return TRUE;
  }

  protected function resolveAttributesInContent(Collection $formElements, Attribute $repeatAttribute = null, $repeatValue = null):void {
    $attributeResolver = new AttributeResolver($formElements);
    $this->content['text'] = $attributeResolver->resolveText($this->content['text'], true);
    if(isset($repeatAttribute)){
      $this->content['text'] = MultiAttributeResolver::resolve($repeatAttribute, $this->content['text'], $repeatValue);
    }
  }

  public function counterResolve(string $matchString, int $countStart, Contract $contract): int {
    $attributeResolver = new CounterResolver($matchString, $countStart, $contract);
    $this->content['text'] = $attributeResolver->resolveText($this->content['text']);
    return $attributeResolver->getCounter();
  }

  public function findVariable(Contract $contract): Collection {
    $variableArray = parent::findVariable($contract);

    preg_match_all('/{(\d+)}/', $this->content['text'], $output_array);

    foreach ($output_array[1] as $output) {
      $variableArray->push([$this->id, $output]);
    }

    preg_match_all('/{(\d+):\d+}/', $this->content['text'], $output_array);

    foreach ($output_array[1] as $output) {
      $variableArray->push([$this->id, $output]);
    }

    preg_match_all('/{(\d+):(?>number|currency|words)}/', $this->content['text'], $output_array);

    foreach ($output_array[1] as $output) {
      $variableArray->push([$this->id, $output]);
    }

    return $variableArray;
  }

  public function renderToHtml(Collection $attributes, Attribute $repeatAttribute = null, $repeatValue = null): string {
    $htmlString = parent::renderToHtml($attributes, $repeatAttribute, $repeatValue);
    return $htmlString . $this->content['text'];
  }
}
