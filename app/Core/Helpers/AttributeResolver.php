<?php


namespace App\Core\Helpers;


use App\Core\Contracts\IAggregableByAttributeAggregator;
use App\Core\Enums\AttributeType;
use App\Core\Enums\ElementType;
use App\Core\Models\Domain\Attributes\Attribute;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AttributeResolver {

  protected Collection $formElements;

  public function __construct(Collection $formElements) {
    $this->formElements = $formElements;
  }

  public function resolveText(string $text, bool $resolveGroup = FALSE) {
    preg_match_all('/{(\d+)}/', $text, $attributeIdList);

    foreach ($attributeIdList[1] as $id) {
      $attribute = $this->getAttributeById((int) $id);
      if (isset($attribute)) {
        $text = str_replace([
          '{' . $id . '}',
        ], [
          $this->escapeValue($attribute->getValue()),
        ], $text);
      }
    }

    preg_match_all('/{(\d+):counter}/', $text, $attributeIdList);
    foreach ($attributeIdList[1] as $id) {
      $attribute = $this->getAttributeById((int) $id);
      if (isset($attribute) && (bool)$attribute->settings['isMultiUse']) {
        $text = str_replace([
          '{' . $id . ':counter}',
        ], [
          $attribute->isActive ? count($attribute->value) : 0,
        ], $text);
      }
    }

    //currency attribute
    preg_match_all('/{(\d+):(?>number|words|currency)}/', $text, $attributeIdList);
    foreach ($attributeIdList[1] as $id) {
      $attribute = $this->getAttributeById((int) $id);
      if (isset($attribute)) {
        $text = str_replace([
          '{' . $id . ':number}',
          '{' . $id . ':words}',
          '{' . $id . ':currency}',
        ], [
          $this->escapeValue($attribute->getRavValue()['number']),
          $this->escapeValue($attribute->getWords()),
          $this->escapeValue($attribute->getRavValue()['currency']),
        ], $text);
      }
    }
    //currency attribute end

    if ($resolveGroup) {
      preg_match_all('/{(\d+):\d+}/', $text, $attributeIdList);

      foreach ($attributeIdList[1] as $id) {
        $attribute = $this->getAttributeById((int) $id);
        if (isset($attribute) && !((bool) $attribute->settings['isMultiUse'])) {
          foreach ($attribute->value as $attribute) {
            $attributeParse = Attribute::getFromString((array) $attribute);
            $text = str_replace([
              '{' . $id . ':' . $attributeParse->id . '}',
            ], [
              $this->escapeValue($attributeParse->getValue()),
            ], $text);
          }
        }
      }
    }

    return $text;
  }

  public function getAttributeById(int $id): ?Attribute {
    return $this->formElements
      ->where('elementType', ElementType::ATTRIBUTE)
      ->map(static function ($e) {
        return $e->attribute;
      })
      ->where('id', $id)
      ->first();
  }

  protected function getAttributeValueById(int $id): string {
    $attribute = $this->getAttributeById($id);
    $value = isset($attribute) ? $attribute->getValue() : '';

    return $this->escapeValue($value);
  }

  protected function escapeValue(?string $value): string {
    if(!isset($value)) return '';

    if (Str::endsWith($value, "'") && Str::startsWith($value, "'")) {
      $value = Str::substr($value, 1, Str::length($value) - 2);
    }

    return $value;
  }
}
