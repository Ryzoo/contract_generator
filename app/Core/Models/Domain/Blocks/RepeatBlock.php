<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Helpers\AttributeResolver;
use App\Core\Helpers\CounterResolver;
use App\Core\Helpers\MultiRender;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\FormElements\PageDividerFormElement;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class RepeatBlock extends TextBlock {

  /**
   * @var ?\App\Core\Models\Domain\Attributes\RepeatGroupAttribute $repeatAttribute
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

  protected function resolveAttributesInContent(Collection $formElements) {
    $attributeResolver = new AttributeResolver($formElements);
    $this->content['text'] = $attributeResolver->resolveText($this->content['text']);
    $this->repeatAttribute = $attributeResolver->getAttributeById($this->settings['repeatAttributeId'] ?? -1);
  }

  public function renderToHtml(Collection $attributes): string {
    $htmlString = parent::renderToHtml($attributes);
    return $this->repeatContent($htmlString . $this->content['text']);
  }

  private function repeatContent(string $content) {
    // TODO
    if(isset($this->repeatAttribute)){
//      $value = MultiRender::prepareValue($this->repeatAttribute->value)[0];
//      foreach ($value as $attribute) {
//        foreach ($attribute as $field) {
//          $body .= "<td>$item</td>";
//        }
//      }
      return $content;
    }

    return $content;
  }
}
