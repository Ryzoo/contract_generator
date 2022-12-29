<?php

namespace App\Core\Services\Contract;

use App\Core\Enums\BlockType;
use App\Core\Enums\ElementType;
use App\Core\Models\Database\Contract;
use App\Core\Models\Database\Form;
use App\Core\Models\Domain\Attributes\Attribute;
use App\Core\Models\Domain\Blocks\Block;
use App\Core\Models\Domain\FormElements\AttributeFormElement;
use App\Core\Models\Domain\FormElements\FormElement;
use Illuminate\Support\Collection;

class FormService {
  private ConditionalService $conditionalService;

  public function __construct(ConditionalService $conditionalService) {
    $this->conditionalService = $conditionalService;
  }

  public function createFormElementsCollection(Contract $contract):Collection {
    $blocks = $contract->blocks;

    $formElementsCollection = collect();

    /* @var $block Block */
    foreach ($blocks as $block) {
      $formElementsCollection = $formElementsCollection->merge($block->getFormElements($contract));
    }

    $formElementsCollection = $this->conditionalService
      ->initializeConditionalInFormElementsCollection($contract, $formElementsCollection);
    $formElementsCollection = $formElementsCollection->unique();
    
    return $this->reduceElementsWithSameAttribute($formElementsCollection);
  }

  public function createFromContract(Contract $contract): Form {
    $formElementsCollection = $this->createFormElementsCollection($contract);

    if (isset($contract->form)) {
      $contract->form->update([
        'formElements' => $formElementsCollection,
      ]);
      return $contract->form;
    }

    return Form::create([
      'contract_id' => $contract->id,
      'formElements' => $formElementsCollection,
    ]);
  }

  private function reduceElementsWithSameAttribute(Collection $existElements): Collection {
    $newCollection = collect();

    /**
     * @var FormElement $element
     */
    foreach ($existElements as $element){
      if($element->elementType !== ElementType::ATTRIBUTE){
        $newCollection->push($element);
        continue;
      }

      $atrId = $element->attribute->id;

      $sameElement = $newCollection->first(static function(FormElement $value)use($atrId){
        return $value->elementType === ElementType::ATTRIBUTE && $value->attribute->id === $atrId;
      });

      if(!isset($sameElement)){
        $newElement = clone $element;
        $newElement->conditionals = $this->getAllConditionalsFromAttribute($existElements, $atrId);
        $newCollection->push($newElement);
      }
    }

    return $newCollection;
  }

  private function getAllConditionalsFromAttribute(Collection $existElements, int $atrId): array {
    $collectionOfConditionals = collect();

    foreach ($existElements as $element){
      if($element->elementType === ElementType::ATTRIBUTE && $element->attribute->id === $atrId && !empty($element->conditionals)){
        $collectionOfConditionals->push(collect($element->conditionals));
      }
    }

    return $collectionOfConditionals->filter()->toArray();
  }
}
