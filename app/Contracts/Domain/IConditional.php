<?php


namespace App\Contracts\Domain;



use Illuminate\Support\Collection;

interface IConditional {
    public static function validate($value): bool;
    public static function getListFromString(string $value): array;
    public static function getFromString(array $value): IConditional;
    public static function getConditionalByType(int $conditionalType):IConditional;
    public function getUsedVariable(): Collection;
}
