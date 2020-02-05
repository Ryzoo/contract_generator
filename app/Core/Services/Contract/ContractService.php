<?php


namespace App\Core\Services\Contract;


use App\Core\Enums\ConditionalType;
use App\Core\Helpers\BlockCounterResolver;
use App\Core\Helpers\PdfRenderer;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\FormElements\FormElement;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ContractService {

  /**
   * @var FormService
   */
  private $formService;

  public function __construct(FormService $formService) {
    $this->formService = $formService;
  }

  public function createContract(Contract $contract): Contract {
    DB::transaction(function () use (&$contract) {
      $contract->save();

      $this->formService->createFromContract($contract);
    });

    return $contract;
  }

  public function removeContractById(array $contractList) {
    foreach ($contractList as $contractId) {
      $contract = Contract::with('form', 'completedForm', 'categories')
        ->findOrFail($contractId);

      DB::transaction(static function () use (&$contract) {
        $contract->form()->delete();
        $contract->categories()->detach();
        $contract->completedForm()->delete();
        $contract->delete();
      });
    }
  }

  public function renderContract(int $contractId, Collection $formElements) {
    $contract = Contract::findOrFail($contractId);
    $blocks = $this->prepareRenderBlock($contract->blocks, $formElements, $contract);

    $pdfRenderer = new PdfRenderer();
    $pdfRenderer->setParameters($contract, $blocks, $formElements);

    return $pdfRenderer->preparePdf();
  }

  private function prepareRenderBlock(Collection $blockCollection, Collection $formElements, Contract $contract): Collection {

    /**
     * @var FormElement $element
     */
    foreach ($formElements as &$element) {
      $element->resolveAttributesInSettings($formElements);
    }

    /** @var \App\Core\Models\Domain\Blocks\Block $block */
    foreach ($blockCollection as &$block) {
      $block->validateConditions(ConditionalType::SHOW_ON, $formElements, $contract);
    }

    $availableBlocks = $blockCollection->where('isActive', TRUE);
    return BlockCounterResolver::resolveCounter($availableBlocks, $contract);
  }
}
