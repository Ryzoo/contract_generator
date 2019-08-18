<?php


namespace App\Contracts\Domain;

interface IBlock {
    public static function validate($value): bool;
    public static function getListFromString(string $value): array;
    public static function getFromString($value): IBlock;
    public static function getBlockByType(int $blockType): IBlock;
}
