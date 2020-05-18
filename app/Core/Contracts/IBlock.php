<?php


namespace App\Core\Contracts;

use App\Core\Models\Domain\Attributes\Attribute;
use App\Core\Models\Domain\Blocks\Block;
use App\Core\Models\Database\Contract;
use Illuminate\Support\Collection;

interface IBlock {
    public static function validate($value): bool;
    public static function getListFromString(string $value): array;
    public static function getFromString(array $value): Block;
    public static function getBlockByType(int $blockType): Block;
    public function getBlockCollection(Collection $blockCollection): Collection;
    public function renderToHtml(Collection $attributes, Attribute $repeatAttribute = null, $repeatValue = null): string;
    public function findVariable(Contract $contract): Collection;
    public function getFormElements(Contract $contract): Collection;
}
