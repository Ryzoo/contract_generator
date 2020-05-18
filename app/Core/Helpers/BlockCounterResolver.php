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
    $defaultStart = $settings->counterStart;

    $blockCollection = self::resolve('paragraph-counter', $blockCollection, $contract, $defaultStart)['data'];

    return $blockCollection;
  }

  public static function resolve(string $matchString, Collection $blockCollection, Contract $contract, int $countStart = 1): array {
    /**
     * @var Block block
     */
    foreach ($blockCollection as &$block) {
      $countStart = $block->counterResolve($matchString, $countStart, $contract);
    }

    return [
      'data' => $blockCollection,
      'count' => $countStart,
    ];
  }

}
