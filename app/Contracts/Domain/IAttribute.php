<?php


namespace App\Contracts\Domain;


use App\Models\Domain\Attributes\Attribute;

interface IAttribute {
    public static function validate($value): bool;
    public static function getListFromString(string $value): array;
    public static function getFromString(array $value): Attribute;
    public static function getAttributeByType(int $attributeType): Attribute;
}
