<?php

namespace App\Core\Services\Contract;

use App\Core\Enums\ElementType;
use App\Core\Models\Database\Contract;
use App\Core\Models\Database\Form;
use App\Core\Models\Domain\FormElements\AttributeFormElement;
use App\Core\Models\Domain\FormElements\FormElement;
use Illuminate\Support\Collection;

class FormService {

  /**
   * @var ConditionalService
   */
  private $conditionalService;

  public function __construct(ConditionalService $conditionalService) {
    $this->conditionalService = $conditionalService;
  }

  public function createFromContract(Contract $contract): Form {
    $blocks = $contract->blocks;

    $formElementsCollection = collect();

    /* @var $block \App\Core\Models\Domain\Blocks\Block */
    foreach ($blocks as $block) {
      $elements = $this->reduceElementsWithSameAttribute($block->getFormElements($contract), $formElementsCollection);
      $formElementsCollection = $formElementsCollection->merge($elements);
    }
    $formElementsCollection = $formElementsCollection->unique();

    $formElementsCollection = $this->conditionalService
      ->initializeConditionalInFormElementsCollection($contract, $formElementsCollection);

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

  private function reduceElementsWithSameAttribute(Collection $newElements, Collection $existElements): Collection {
    return $newElements->reject(static function (FormElement $value) use ($existElements) {

      if ($value->elementType === ElementType::ATTRIBUTE) {
        return $existElements->some(static function (FormElement $item) use ($value) {
          if ($item->elementType !== ElementType::ATTRIBUTE) {
            return FALSE;
          }

          return $value->attribute === $item->attribute;
        });
      }

      return FALSE;
    });
  }
}
