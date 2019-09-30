<?php


namespace App\Contracts\Domain;

use App\Models\Domain\FormElements\FormElement;
use Illuminate\Support\Collection;

interface IFormElement {
    public static function validate($value): bool;
    public static function getFormElementByType(int $formElementType, array $value): FormElement;
    public static function getListFromString(string $value): Collection;
    public static function getFromString(array $value): FormElement;
}
