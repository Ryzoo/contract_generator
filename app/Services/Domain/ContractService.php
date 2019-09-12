<?php


namespace App\Services\Domain;


use App\Helpers\PdfRenderer;
use App\Models\Domain\Contract;
use App\Repository\Domain\ContractRepository;
use Illuminate\Support\Facades\DB;

class ContractService {
    /**
     * @var FormService
     */
    private $formService;

    /**
     * @var \App\Repository\Domain\ContractRepository
     */
    private $contractRepository;


    public function __construct(FormService $formService, ContractRepository $contractRepository) {
        $this->formService = $formService;
        $this->contractRepository = $contractRepository;
    }

    public function addContract(Contract $contract): Contract {
        DB::transaction(function() use(&$contract) {
            Contract::validate($contract);
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

    public function renderContract(int $contractID, array $attributes) {
        $contract = $this->contractRepository->getById($contractID);
        $blocks = $contract->blocks;

        $pdfRenderer = new PdfRenderer();
        $pdfRenderer->setParameters($contract, $blocks, $attributes);

        return $pdfRenderer->preparePdf();
    }
}
