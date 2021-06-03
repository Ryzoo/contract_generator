<?php


namespace App\Core\Modules;


use App\Core\Modules\Contract\Auth;
use App\Core\Modules\Contract\ContractModule;
use App\Core\Modules\Contract\Payment;
use App\Core\Modules\Contract\Provider;
use App\Core\Services\Contract\ContractService;
use Illuminate\Support\Collection;

class Configuration {
    public array $availableModules;

    public function __construct(ContractService $contractService) {
        $this->availableModules = [
            new Auth(),
            new Payment(),
            new Provider($contractService),
        ];
    }

    public function getAvailableModules(): Collection {
        $collectionOfModulesInformation = collect();

        /**
         * @var ContractModule $module
         */
        foreach ($this->availableModules as $module) {
            $collectionOfModulesInformation->push($module->getInformation());
        }

        return $collectionOfModulesInformation;
    }
}
