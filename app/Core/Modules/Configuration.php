<?php


namespace App\Core\Modules;


use App\Core\Modules\Contract\Auth;
use App\Core\Modules\Contract\Provider;
use App\Core\Services\Domain\ContractService;

class Configuration {

    public $availableModules;

    public function __construct(ContractService $contractService) {
        $this->availableModules = [
            new Auth(),
            new Provider($contractService),
        ];
    }

    public function getAvailableModules(){
        $collectionOfModulesInformation = collect();

        /**
         * @var \App\Core\Modules\Contract\ContractModule $module
         */
        foreach ($this->availableModules as $module)
            $collectionOfModulesInformation->push($module->getInformation());

        return $collectionOfModulesInformation;
    }
}
