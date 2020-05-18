<?php


namespace App\Core\Models\Domain\Conditional;


use App\Core\Contracts\IConditional;
use App\Core\Enums\ConditionalType;
use App\Core\Helpers\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Whoops\Exception\ErrorException;

abstract class Conditional implements IConditional {

  public int $conditionalType;

  public ?string $conditionalName;

  public string $content;

  protected function initialize(int $conditionalType): void {
    $this->conditionalType = $conditionalType;
    $this->conditionalName = ConditionalType::getName($conditionalType);
    $this->content = '';
  }

  public static function getConditionalByType(int $conditionalType): Conditional {
    switch ($conditionalType) {
      case ConditionalType::SHOW_ON:
        return new ShowOn();
    }

    throw new ErrorException("Conditional {$conditionalType} was not found");
  }

  public static function validate($value): bool {
    Validator::validate($value, [
      'conditionalType' => 'required|integer',
      'content' => 'required',
    ]);

    return TRUE;
  }

  public static function getListFromString(string $value): array {
    $arrayOfConditional = json_decode($value, TRUE, 512, JSON_THROW_ON_ERROR);
    $returnedArray = [];

    if (!is_array($arrayOfConditional)) {
      Response::error(_('custom.array.attributes'));
    }

    foreach ($arrayOfConditional as $conditional) {
      if (is_array($conditional) && !isset($conditional['conditionalType'])) {
        $arIn = [];
        foreach ((array) $conditional as $condOne) {
          $arIn [] = self::getFromString((array) $condOne);
        }
        $returnedArray[] = $arIn;
      }
      else {
        $returnedArray[] = self::getFromString((array) $conditional);
      }
    }

    return $returnedArray;
  }

  public static function getFromString(array $value): Conditional {
    Conditional::validate($value);
    $conditional = self::getConditionalByType($value['conditionalType']);

    $conditional->conditionalType = $value['conditionalType'];
    $conditional->conditionalName = ConditionalType::getName($value['conditionalType']);
    $conditional->content = $value['content'];

    return $conditional;
  }

  public function getUsedVariable(): Collection {
    preg_match_all('/"id": ?"?(\d+)"?,/', $this->content, $output_array);
    $allElements = collect();

    if (isset($output_array[1]) && is_array($output_array[1])) {
      foreach ($output_array[1] as $item) {
        $allElements->push($item);
      }
    }

    preg_match_all('/"id": ?"?(\d+):(?>number|currency|words|counter|\d+|value)"?,/', $this->content, $output_array);
    if (isset($output_array[1]) && is_array($output_array[1])) {
      foreach ($output_array[1] as $item) {
        $allElements->push($item);
      }
    }

    return $allElements->unique();
  }
}
