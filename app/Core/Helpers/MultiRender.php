<?php


namespace App\Core\Helpers;


use App\Core\Enums\MultiUseRenderType;
use App\Core\Models\Domain\Attributes\Attribute;

class MultiRender {

  public static function renderToHTML(array $value, $type):string {
    $value = self::prepareValue($value);

    switch ($type){
      case MultiUseRenderType::TABLE:
        return self::prepareHTMLTable($value);
      case MultiUseRenderType::COMMA_SEPARATED:
        return self::prepareHTMLSeparated($value, ', ');
      case MultiUseRenderType::LIST:
        return self::prepareHTMLList($value, ', ');
    }

    return 'error when parse multi use';
  }

  private static function prepareValue(array $value) {
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
    $itemsList = $value[0];
    $headers = $value[1];

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

  private static function prepareHTMLList($value, string $glue) {
    $itemsList = $value[0];
    $body = '';

    foreach ($itemsList as $items) {
      $elements = implode($glue, $items->toArray());
      $body .= "<li>{$elements}</li>";
    }

    return "<br/><ul width='100%'>$body</ul>";
  }

  private static function prepareHTMLSeparated($value, string $glue) {
    $itemsList = $value[0];
    $elements = [];

    foreach ($itemsList as $items) {
      $elements[] = implode($glue, $items->toArray());
    }

    return implode($glue, $elements);
  }
}
