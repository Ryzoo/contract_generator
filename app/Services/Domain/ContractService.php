<?php


namespace App\Services\Domain;


use App\Models\Domain\Contract;
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

    public function addContract(Contract $contract): Contract {
        DB::transaction(function() use(&$contract) {
            Contract::validate($contract);
            $contract->save();

            $this->formService->createFromContract($contract);
        });

        return $contract;
    }

    public function getContractCollection(): Collection {
        return Contract::all();
    }

    public function removeContractById(int $contractID){
        $contract = Contract::getById($contractID);

        DB::transaction(function() use(&$contract) {
            $contract->form->delete();
            $contract->delete();
        });
    }

}
