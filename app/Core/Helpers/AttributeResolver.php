<?php


namespace App\Core\Helpers;


use App\Core\Enums\ElementType;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AttributeResolver {

  /**
   * @var \Illuminate\Support\Collection
   */
  protected $formElements;

  public function __construct(Collection $formElements) {
    $this->formElements = $formElements;
  }

  public function resolveText(string $text) {
    preg_match_all('/{(\d+)}/', $text, $attributeIdList);

    foreach ($attributeIdList[1] as $id) {
      $value = $this->getAttributeValueById((int) $id);

      if(strpos($value, '<table') !== false){
        $text = str_replace([
          '<p>{' . $id . '}</p>',
          '<p> {' . $id . '} </p>',
          '<p>{' . $id . '} </p>',
          '<p> {' . $id . '}</p>',
          '{' . $id . '}</p>',
          '{' . $id . '} </p>',
          '{' . $id . '}'
        ], [
          '{' . $id . '}',
          '{' . $id . '}',
          '{' . $id . '}',
          '{' . $id . '}',
          '</p> {' . $id . '}',
          '</p> {' . $id . '}',
          $value
        ], $text);
      }else{
        $text = str_replace([
          '{' . $id . '}'
        ], [
          $value
        ], $text);
      }
    }

    return $text;
  }

  protected function getAttributeValueById(int $id): string {
    $attribute = $this->formElements
      ->where('elementType', ElementType::ATTRIBUTE)
      ->map(static function ($e) {
        return $e->attribute;
      })
      ->where('id', $id)
      ->first();

    $value = isset($attribute) ? $attribute->getValue() : '';

    return $this->escapeValue($value);
  }

  protected function escapeValue(string $value): string {
    if (Str::endsWith($value, "'") && Str::startsWith($value, "'")) {
      $value = Str::substr($value, 1, Str::length($value) - 2);
    }

    return $value;
  }
}
