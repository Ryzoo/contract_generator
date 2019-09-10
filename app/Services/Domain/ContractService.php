<?php


namespace App\Services\Domain;


use App\Models\Domain\Contract;
use App\Repository\Domain\ContractRepository;
use App\Repository\Domain\FormRepository;
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

    public function removeContractById(int $contractID){
        $contract = $this->contractRepository->getById($contractID);

        DB::transaction(function() use(&$contract) {
            $contract->form->delete();
            $contract->delete();
        });
    }
}
