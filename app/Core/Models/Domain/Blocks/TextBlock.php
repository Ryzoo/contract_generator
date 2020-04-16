<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Helpers\AttributeResolver;
use App\Core\Helpers\CounterResolver;
use Illuminate\Support\Facades\Validator;
use App\Core\Models\Database\Contract;
use Illuminate\Support\Collection;

class TextBlock extends Block {

  public function __construct() {
    $this->initialize(BlockType::TEXT_BLOCK);
  }

  protected function buildSettings() {
    // TODO: Implement buildSettings() method.
  }

  protected function buildContent() {
    // TODO: Implement buildContent() method.
  }

  protected function validateContent(): bool {
    Validator::validate($this->content, [
      'text' => 'nullable|string',
    ]);

    return TRUE;
  }

  protected function resolveAttributesInContent(Collection $formElements) {
    $attributeResolver = new AttributeResolver($formElements);
    $this->content['text'] = $attributeResolver->resolveText($this->content['text'], true);
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

    return $variableArray->uniqueStrict('1');
  }

  public function renderToHtml(Collection $attributes): string {
    $htmlString = parent::renderToHtml($attributes);
    return $htmlString . $this->content['text'];
  }
}
