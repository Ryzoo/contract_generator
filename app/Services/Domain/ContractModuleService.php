<?php


namespace App\Services\Domain;


use App\Models\Domain\Contract;
use App\Modules\Configuration;

class ContractModuleService {

    /**
     * @var \App\Modules\Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration) {
        $this->configuration = $configuration;
    }

    public function runPart(Contract $contract, int $partType, array $attributes = []){
        foreach ($this->configuration->availableModules as $module){
            if($contract->checkContractEnabledModules($module->name)){
                $module->run($contract, $partType, $attributes);
            }
        }
    }

}
