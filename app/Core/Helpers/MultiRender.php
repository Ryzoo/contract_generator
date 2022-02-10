<?php


namespace App\Core\Helpers;


use App\Core\Enums\MultiUseRenderType;
use App\Core\Models\Domain\Attributes\Attribute;

class MultiRender {

  public static function renderToHTML($value, $type, $valueAsAttributesArray = true):string {
    if(!isset($value)) {
      return '';
    }

    if(!is_array($value)) return $value;

    $value = $valueAsAttributesArray ? self::prepareAttributeValue($value) : $value;

    switch ($type){
      case MultiUseRenderType::TABLE:
        return self::prepareHTMLTable($valueAsAttributesArray ? $value : [
          $value, collect($value)->map(static function(){return '';})
        ]);
      case MultiUseRenderType::COMMA_SEPARATED:
        return self::prepareHTMLSeparated($valueAsAttributesArray ? $value[0] : $value, ', ', $valueAsAttributesArray);
        case MultiUseRenderType::LIST:
        case MultiUseRenderType::LIST_ALFA:
        case MultiUseRenderType::LIST_NUMBER:
        return self::prepareHTMLList($valueAsAttributesArray ? $value[0] : $value, ', ', $valueAsAttributesArray, $type);
    }

    return 'error when parse multi use';
  }

  public static function prepareAttributeValue(array $value):array {
    $attributesValue = collect();
    $attributesName = collect();

    foreach ($value as $attributes) {
      $attributeValue = collect();

      /**
       * @var Attribute $attribute
       */
      foreach ($attributes as $attribute) {
        $attributeParse = Attribute::getFromString((array) $attribute);

        if ($attributesName->count() < count($attributes)) {
          $attributesName->push($attributeParse->attributeName);
        }

        $attributeValue->push($attributeParse->getValue());
      }

      $attributesValue->push($attributeValue);
    }

    return [
      $attributesValue,
      $attributesName
    ];
  }

  private static function prepareHTMLTable($value) {
    [$itemsList, $headers] = $value;

    $header = '<tr>';
    foreach ($headers as $item) {
      $header .= "<th>$item</th>";
    }
    $header .= '</tr>';

    $body = '';
    foreach ($itemsList as $items) {
      $body .= '<tr>';
      foreach ($items as $item) {
        $body .= "<td>$item</td>";
      }
      $body .= '</tr>';
    }

    return "<br/><table width='100%'><thead>$header</thead><tbody>$body</tbody></table>";
  }

  private static function prepareHTMLList($value, string $glue, bool $valueAsAttributesArray, MultiUseRenderType $type): string {
    $body = '';

    foreach ($value as $items) {
      $elements = $valueAsAttributesArray ? implode($glue, $items->toArray()) : $items;
      $body .= "<li>$elements</li>";
    }

    switch ($type){
        case MultiUseRenderType::LIST:
            return "<br/><ul width='100%' style='list-style-type: disc;'>$body</ul>";
        case MultiUseRenderType::LIST_NUMBER:
            return "<br/><ol width='100%' style='list-style-type: decimal;'>$body</ol>";
        case MultiUseRenderType::LIST_ALFA:
            return "<br/><ol width='100%' style='list-style-type: lower-alpha;'>$body</ol>";
    }

    return "<br/><ul width='100%'>$body</ul>";
  }

  private static function prepareHTMLSeparated($value, string $glue, bool $valueAsAttributesArray): string {
    if(!$valueAsAttributesArray){
      return implode($glue, $value);
    }

    $elements = [];

    foreach ($value as $items) {
      $elements[] = implode($glue, $items->toArray());
    }

    return implode($glue, $elements);
  }
}
