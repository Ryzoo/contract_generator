<?php


namespace App\Contracts\Domain;


interface IAttribute {
    public static function validate($value): bool;
    public static function getListFromString(string $value): array;
    public static function getFromString(array $value): IAttribute;
    public static function getAttributeByType(int $attributeType): IAttribute;
}
