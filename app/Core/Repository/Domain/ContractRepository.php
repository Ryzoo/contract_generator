<?php


namespace App\Core\Repository\Domain;


use App\Core\Models\Domain\Contract;
use Illuminate\Support\Collection;
use Whoops\Exception\ErrorException;

class ContractRepository {

    public function getContractCollection(): Collection {
        return Contract::select(["id", "name", "created_at"])->get();
    }

    public static function getById(int $contractID):?Contract{
        $contract = Contract::where("id", $contractID)->first();

        if(!isset($contract))
            throw new ErrorException("Contract {$contractID} was not found");

        return $contract;
    }
}
