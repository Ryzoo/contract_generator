<?php


namespace App\Services\Domain;


use App\Models\Domain\Contract;
use Illuminate\Support\Facades\DB;

class ContractService {

    /**
     * @var FormService
     */
    private $formService;

    public function __construct(FormService $formService) {
        $this->formService = $formService;
    }

    public function addContract(Contract $contract) {

        DB::transaction(function() use(&$contract) {
            Contract::validate($contract);
            $contract->save();

            $this->formService->createFromContract($contract);
        });

        return $contract;
    }
}
