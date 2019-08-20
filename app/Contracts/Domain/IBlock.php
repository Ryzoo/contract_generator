<?php


namespace App\Contracts\Domain;

use Illuminate\Support\Collection;

interface IBlock {
    public static function validate($value): bool;
    public static function getListFromString(string $value): array;
    public static function getFromString(array $value): IBlock;
    public static function getBlockByType(int $blockType): IBlock;
    public function findVariable(Collection $variableArray): Collection;
}
