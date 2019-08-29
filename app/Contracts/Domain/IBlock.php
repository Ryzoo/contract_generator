<?php


namespace App\Contracts\Domain;

use App\Models\Domain\Blocks\Block;
use Illuminate\Support\Collection;

interface IBlock {
    public static function validate($value): bool;
    public static function getListFromString(string $value): array;
    public static function getFromString(array $value): Block;
    public static function getBlockByType(int $blockType): Block;
    public function findVariable(Collection $variableArray): Collection;
}
