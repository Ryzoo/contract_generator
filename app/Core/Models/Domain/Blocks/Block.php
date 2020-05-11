<?php


namespace App\Core\Models\Domain\Blocks;


use App\Core\Contracts\IBlock;
use App\Core\Enums\BlockType;
use App\Core\Models\Domain\Attributes\Attribute;
use App\Core\Traits\ConditionalValidator;
use Illuminate\Support\Facades\Validator;
use App\Core\Models\Domain\Conditional\Conditional;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\FormElements\AttributeFormElement;
use Illuminate\Support\Collection;
use Intervention\Image\Exception\NotFoundException;
use Whoops\Exception\ErrorException;

abstract class Block implements IBlock {

  use ConditionalValidator;

  public int $id;

  public int $blockType;

  public ?string $blockName;

  public int $parentId;

  public array $settings;

  public array $conditionals;

  public array $content;

  abstract protected function buildSettings(): void;

  abstract protected function buildContent(): void;

  abstract protected function validateContent(): bool;

  abstract protected function resolveAttributesInContent(Collection $formElements, Attribute $repeatAttribute = NULL, $repeatValue = NULL):void;

  protected function initialize(int $blockType): void {
    $this->blockType = $blockType;
    $this->blockName = BlockType::getName($blockType);
    $this->settings = [];
    $this->id = 0;
    $this->parentId = 0;
    $this->content = [];
    $this->conditionals = [];
    $this->buildObject();
  }

  protected function buildObject(): void {
    $this->buildSettings();
  }

  protected function prepare(): void {
    $this->validateContent();
    $this->buildContent();
  }

  public static function getBlockByType(int $blockType): Block {
    switch ($blockType) {
      case BlockType::TEXT_BLOCK:
        return new TextBlock();
      case BlockType::EMPTY_BLOCK:
        return new EmptyBlock();
      case BlockType::PAGE_DIVIDE_BLOCK:
        return new PageDivideBlock();
      case BlockType::REPEAT_BLOCK:
        return new RepeatBlock();
      case BlockType::LIST_BLOCK:
        return new ListBlock();
      case BlockType::LIST_ITEM_BLOCK:
        return new ListItemBlock();
    }

    throw new NotFoundException("Block {$blockType} was not found");
  }

  public static function validate($value): bool {
    Validator::validate($value, [
      'id' => 'required|integer',
      'parentId' => 'required|integer',
      'blockType' => 'required|integer',
      'content' => 'nullable',
      'conditionals' => 'nullable|array',
      'settings' => 'nullable',
    ]);

    return TRUE;
  }

  public static function getListFromString(string $value): array {
    $arrayOfBlocks = json_decode($value, TRUE, 512, JSON_THROW_ON_ERROR);
    $returnedArray = [];

    if (!is_array($arrayOfBlocks)) {
      throw new ErrorException(_('custom.array.attributes'), 500);
    }

    foreach ($arrayOfBlocks as $block) {
      $returnedArray[] = self::getFromString((array) $block);
    }

    return $returnedArray;
  }

  public static function getFromString(array $value): Block {
    Block::validate($value);
    $block = self::getBlockByType($value['blockType']);

    $block->id = (int) $value['id'];
    $block->parentId = (int) $value['parentId'];
    $block->blockType = (int) $value['blockType'];
    $block->blockName = $value['blockName'];
    $block->settings = $value['settings'];
    $block->conditionals = Conditional::getListFromString(json_encode($value['conditionals'], JSON_THROW_ON_ERROR, 512));
    $block->content = (array) $value['content'];

    $block->prepare();

    return $block;
  }

  public function findVariable(Contract $contract): Collection {
    $variableArray = collect();

    foreach ($this->conditionals as $conditional) {
      $conditionalVariablesList = $conditional->getUsedVariable();
      foreach ($conditionalVariablesList as $arrayElement) {
        $variableArray->push([$this->parentId, $arrayElement]);
      }
    }

    return $variableArray;
  }

  public function getFormElements(Contract $contract): Collection {
    $variableArray = $this->findVariable($contract);
    $elementCollection = collect();

    $variableArray->map(static function ($element) use ($contract, $elementCollection) {
      $parentBlockId = (int) $element[0];
      $attributeId = (int) $element[1];
      $elementCollection->push(new AttributeFormElement($parentBlockId, $contract->getAttributeByID($attributeId)));
    });

    return $elementCollection;
  }

  public function getBlockCollection(Collection $blockCollection): Collection {
    $blockCollection->push($this);
    return $blockCollection;
  }

  public function renderToHtml(Collection $attributes, Attribute $repeatAttribute = NULL, $repeatValue = NULL): string {
    $this->resolveAttributesInContent($attributes, $repeatValue, $repeatValue);
    return '';
  }

  public function renderAdditionalCss(): string {
    return '';
  }

  public function counterResolve(string $matchString, int $countStart, Contract $contract): int {
    return $countStart;
  }
}
