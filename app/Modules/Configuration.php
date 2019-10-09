<?php


namespace App\Modules;


use App\Modules\Contract\Auth;
use App\Modules\Contract\Provider;
use App\Services\Domain\ContractService;

class Configuration {

    public function __construct(ContractService $contractService) {
        $this->availableModules = [
            new Auth(),
            new Provider($contractService),
        ];
    }
}
