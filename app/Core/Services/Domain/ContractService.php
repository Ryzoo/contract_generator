<?php


namespace App\Core\Services\Domain;


use App\Core\Helpers\PdfRenderer;
use App\Core\Models\Domain\Contract;
use App\Core\Repository\Domain\ContractRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ContractService {
    /**
     * @var FormService
     */
    private $formService;

    /**
     * @var \App\Core\Repository\Domain\ContractRepository
     */
    private $contractRepository;


    public function __construct(FormService $formService, ContractRepository $contractRepository) {
        $this->formService = $formService;
        $this->contractRepository = $contractRepository;
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
            $contract = $this->contractRepository->getById($contractId);

            DB::transaction(function() use(&$contract) {
                $contract->form->delete();
                $contract->delete();
            });
        }
    }

    public function renderContract(int $contractID, Collection $formElements) {
        $contract = $this->contractRepository->getById($contractID);
        $blocks = $contract->blocks;

        $pdfRenderer = new PdfRenderer();
        $pdfRenderer->setParameters($contract, $blocks, $formElements);

        return $pdfRenderer->preparePdf();
    }
}
