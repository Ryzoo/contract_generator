<?php


namespace App\Modules\Contract;


use App\Enums\AvailableRenderActionsHook;
use App\Enums\Modules\AuthType;
use App\Enums\Modules\ContractModulePart;
use App\Helpers\Response;
use App\Models\Domain\Contract;

class Provider extends ContractModule {

    public function __construct() {
        $this->name = "provider";

        $actions = [];
        $actions["action-".AvailableRenderActionsHook::AFTER_FORM_END] = "ProviderForContractView";

        $this->setHooksComponents($actions);
    }

    public function run(Contract &$contract, int $partType, array $attributes = []) {
        parent::run($contract, $partType, $attributes);

        switch ($partType){
            default:
                return true;
        }
    }
}
