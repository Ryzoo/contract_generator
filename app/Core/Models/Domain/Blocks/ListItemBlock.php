<?php


namespace App\Core\Models\Domain\Blocks;

use App\Core\Enums\BlockType;
use App\Core\Helpers\AttributeResolver;
use App\Core\Helpers\CounterResolver;
use App\Core\Helpers\MultiAttributeResolver;
use App\Core\Models\Domain\Attributes\Attribute;
use Illuminate\Support\Facades\Validator;
use App\Core\Models\Database\Contract;
use Illuminate\Support\Collection;

class ListItemBlock extends TextBlock {
  public function __construct() {
    parent::__construct();
    $this->initialize(BlockType::LIST_ITEM_BLOCK);
  }
}
