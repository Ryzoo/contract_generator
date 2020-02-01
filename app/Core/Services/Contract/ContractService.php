<?php


namespace App\Core\Services\Contract;


use App\Core\Helpers\PdfRenderer;
use App\Core\Models\Database\Contract;
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
        DB::transaction(function() use(&$contract) {
            $contract->save();

            $this->formService->createFromContract($contract);
        });

        return $contract;
    }

    public function removeContractById(array $contractList){
        foreach ($contractList as $contractId){
            $contract = Contract::findOrFail($contractId);

            DB::transaction(function() use(&$contract) {
                $contract->form->delete();
                $contract->delete();
            });
        }
    }

    public function renderContract(int $contractId, Collection $formElements){
        $contract = Contract::findOrFail($contractId);
        $blocks = $contract->blocks;

        $pdfRenderer = new PdfRenderer();
        $pdfRenderer->setParameters($contract, $blocks, $formElements);

        return $pdfRenderer->preparePdf();
    }
}
