<?php

namespace App\Core\Helpers;

use App\Core\Enums\AttributeType;
use App\Core\Models\Domain\Attributes\Attribute;
use Illuminate\Support\Str;

class MultiAttributeResolver {

  public static function resolve(Attribute $attribute, string $content, $value):string {
    if($attribute->attributeType === AttributeType::ATTRIBUTE_GROUP && is_array($value)) {
      return self::resolveGroupAttributeInContent($attribute, $content, $value);
    }

    return self::resolveDefaultAttributeInContent($attribute, $content, $value);
  }

  private static function resolveGroupAttributeInContent(Attribute $attribute, string $content, $values): string{
    /**
     * @var \App\Core\Models\Domain\Attributes\Attribute $attribute
     */
    foreach ($values as $inAttribute){
      $parsedInAttr = Attribute::getFromString($inAttribute);
      $content = str_replace([
        '{' . $attribute->id . ':'. $parsedInAttr->id .'}'
      ], [
        self::escapeValue($parsedInAttr->getValue())
      ], $content);
    }

    return $content;
  }

  private static function resolveDefaultAttributeInContent(Attribute $attribute, string $content, $value): string{
    $attribute->settings['isMultiUse'] = false;
    $content = str_replace([
      '{' . $attribute->id . ':value}'
    ], [
      self::escapeValue($attribute->valueParser($value))
    ], $content);

    return $content;
  }

  private static function escapeValue(?string $value): string {
    $value = $value ?? '';

    if (Str::endsWith($value, "'") && Str::startsWith($value, "'")) {
      $value = Str::substr($value, 1, Str::length($value) - 2);
    }

    return $value;
  }
}
