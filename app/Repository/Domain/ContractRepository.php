<?php


namespace App\Repository\Domain;


use App\Models\Domain\Contract;
use Illuminate\Support\Collection;
use Intervention\Image\Exception\NotFoundException;

class ContractRepository {
    public function getContractCollection(): Collection {
        return Contract::select(["id","name", "created_at"])->get();
    }

    public static function getById(int $contractID):?Contract{
        $contract = Contract::where("id", $contractID)->first();

        if(!isset($contract))
            throw new NotFoundException("Contract {$contractID} was not found");

        return $contract;
    }
}
