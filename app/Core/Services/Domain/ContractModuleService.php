<?php


namespace App\Core\Services\Domain;


use App\Core\Models\Domain\Contract;
use App\Core\Modules\Configuration;
use Illuminate\Support\Collection;

class ContractModuleService {

    /**
     * @var \App\Modules\Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration) {
        $this->configuration = $configuration;
    }

    public function runPart(Contract &$contract, int $partType, array $attributes = []){

        /** @var \App\Modules\Contract\ContractModule $module */
        foreach ($this->configuration->availableModules as $module){
            if($contract->checkContractEnabledModules($module->name)){
                $returnData = $module->run($contract, $partType, $attributes);

                if(isset($returnData) && gettype($returnData) !== "boolean")
                    return $returnData;
            }
        }

        return null;
    }

    public function getModuleInformation(Contract $contract): Collection {
        $moduleInformationCollection = collect();

        /** @var \App\Modules\Contract\ContractModule $module */
        foreach ($this->configuration->availableModules as $module){
            if($contract->checkContractEnabledModules($module->name)){
                $module->init($contract);
                $moduleInformationCollection->push($module->getInformation());
            }
        }

        return $moduleInformationCollection;
    }

}
