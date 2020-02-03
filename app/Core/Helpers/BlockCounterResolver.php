<?php
namespace App\Core\Helpers;

use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\Blocks\Block;
use App\Core\Models\Domain\ContractSettings;
use Illuminate\Support\Collection;

class BlockCounterResolver {

  public static function resolveCounter(Collection $blockCollection, Contract $contract) {
    /**
     * @var ContractSettings $settings
     */
    $settings = $contract->settings;

    $blockCollection = self::resolve('param', $blockCollection, $contract, $settings->counterStart);

    return $blockCollection;
  }

  private static function resolve(string $matchString, Collection $blockCollection, Contract $contract, int $countStart = 1){
      /**
       * @var Block block
       */
    foreach ($blockCollection as &$block) {
      $countStart = $block->counterResolve($matchString, $countStart, $contract);
    }

    return $blockCollection;
  }

}
