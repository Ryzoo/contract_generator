<?php


namespace App\Core\Services\Contract;


use App\Core\Models\Database\Contract;
use App\Core\Modules\Configuration;
use App\Core\Modules\Contract\ContractModule;
use Illuminate\Support\Collection;

class ContractModuleService {
    private Configuration $configuration;

    public function __construct(Configuration $configuration) {
        $this->configuration = $configuration;
    }

    public function runPart(Contract $contract, int $partType, array $attributes = []): ?bool {
        /** @var ContractModule $module */
        foreach ($this->configuration->availableModules as $module){
            if($contract->checkContractEnabledModules($module->slug)){
                $returnData = $module->run($contract, $partType, $attributes);

                if(!is_bool($returnData)) {
                    return $returnData;
                }
            }
        }

        return null;
    }

    public function getModuleInformation(Contract $contract): Collection {
        $moduleInformationCollection = collect();

        /** @var ContractModule $module */
        foreach ($this->configuration->availableModules as $module){
            if($contract->checkContractEnabledModules($module->slug)){
                $module->init($contract);
                $moduleInformationCollection->push($module->getInformation());
            }
        }

        return $moduleInformationCollection;
    }

}
