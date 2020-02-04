<?php
namespace App\Core\Helpers;

use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\ContractSettings;

class CounterResolver {
  /**
   * @var string
   */
  private $matchString;

  /**
   * @var int
   */
  private $countStart;

  /**
   * @var ContractSettings
   */
  private $contractSettings;

  public function __construct(string $matchString, int $countStart, Contract $contract) {
    $this->contractSettings = $contract->settings;
    $this->matchString = $matchString;
    $this->countStart = $countStart;
  }

  public function resolveText(string $text) {
    preg_match_all("/<span class=\"($this->matchString)\">/", $text, $elementList, PREG_OFFSET_CAPTURE);
    $prevLength = 0;

    foreach ($elementList[0] as $index =>$element){
      $length = strlen($element[0]);
      $startPos = $element[1];
      $text = substr_replace($text, " $this->countStart. ", $startPos + $length + $prevLength, 0);
      $prevLength += strlen(" $this->countStart. ");
      $this->countStart++;
    }

    return $text;
  }

  public function getCounter() {
    return $this->countStart;
  }
}
