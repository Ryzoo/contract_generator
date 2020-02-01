<?php


namespace App\Core\Services\Contract;


use App\Core\Models\Database\Contract;
use App\Core\Modules\Configuration;
use App\Core\Modules\Contract\ContractModule;
use Illuminate\Support\Collection;

class ContractModuleService {
    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration) {
        $this->configuration = $configuration;
    }

    public function runPart(Contract $contract, int $partType, array $attributes = []){

        /** @var ContractModule $module */
        foreach ($this->configuration->availableModules as $module){
            if($contract->checkContractEnabledModules($module->name)){
                $returnData = $module->run($contract, $partType, $attributes);

                if(isset($returnData) && !is_bool($returnData)) {
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
            if($contract->checkContractEnabledModules($module->name)){
                $module->init($contract);
                $moduleInformationCollection->push($module->getInformation());
            }
        }

        return $moduleInformationCollection;
    }

}
