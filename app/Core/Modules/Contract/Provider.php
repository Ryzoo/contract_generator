<?php


namespace App\Core\Modules\Contract;

use App\Core\Enums\Modules\ContractModulesAvailablePlace;
use App\Core\Services\Domain\ContractService;
use App\Core\Enums\AvailableRenderActionsHook;
use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Enums\Modules\ContractProviderType;
use App\Core\Models\Domain\Contract;
use App\Core\Models\Domain\FormElements\FormElement;
use Illuminate\Support\Str;

class Provider extends ContractModule {

    /**
     * @var \App\Core\Services\Domain\ContractService
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
