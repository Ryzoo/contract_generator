<?php


namespace App\Core\Contracts;



use App\Core\Models\Domain\Conditional\Conditional;
use Illuminate\Support\Collection;

interface IConditional {
    public static function validate($value): bool;
    public static function getListFromString(string $value): array;
    public static function getFromString(array $value): Conditional;
    public static function getConditionalByType(int $conditionalType): Conditional;
    public function getUsedVariable(): Collection;
}
