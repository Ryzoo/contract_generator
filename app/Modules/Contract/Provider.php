<?php


namespace App\Modules\Contract;

use App\Enums\Modules\ContractModulesAvailablePlace;
use App\Services\Domain\ContractService;
use App\Enums\AvailableRenderActionsHook;
use App\Enums\Modules\ContractModulePart;
use App\Enums\Modules\ContractProviderType;
use App\Models\Domain\Contract;
use App\Models\Domain\FormElements\FormElement;
use Illuminate\Support\Str;

class Provider extends ContractModule {

    /**
     * @var \App\Modules\Contract\ContractService
     */
    private $contractService;

    public function __construct(ContractService $contractService) {
        $this->name = "provider";
        $this->description = "provider";
        $this->icon = "fas fa-file-export";
        $this->isActive = true;
        $this->place = ContractModulesAvailablePlace::FINISHER;
        $this->configComponent = "ProviderConfigView";

        $actions = [];
        $actions["action-" . AvailableRenderActionsHook::AFTER_FORM_END] = "ProviderForContractView";

        $this->setHooksComponents($actions);
        $this->contractService = $contractService;
    }

    public function run(Contract &$contract, int $partType, array $attributes = []) {
        parent::run($contract, $partType, $attributes);

        switch ($partType) {
            case ContractModulePart::RENDER_CONTRACT:
                return $this->renderContract();
            default:
                return false;
        }
    }

    private function renderContract() {
        $contract = $this->getAttribute('contract');
        $formElements = json_encode($this->getAttribute('formElements'));
        $formElementsList = FormElement::getListFromString($formElements);

        $renderType = $this->getModuleSettings("type");

        switch ($renderType) {
            case ContractProviderType::RENDER:
                $contractPdfFile = $this->contractService
                    ->renderContract($contract->id, $formElementsList);

                return $contractPdfFile->stream(Str::random(8) . ".pdf");
            default:
                return false;
        }
    }
}
