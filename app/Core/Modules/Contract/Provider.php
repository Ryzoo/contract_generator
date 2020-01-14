<?php


namespace App\Core\Modules\Contract;

use App\Core\Enums\ContractFormCompleteStatus;
use App\Core\Enums\Modules\ContractModulesAvailablePlace;
use App\Core\Models\Domain\ContractFormComplete;
use App\Core\Services\Domain\ContractService;
use App\Core\Enums\AvailableRenderActionsHook;
use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Enums\Modules\ContractProviderType;
use App\Core\Models\Domain\Contract;
use App\Jobs\Email\SendRenderEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class Provider extends ContractModule {

    /**
     * @var ContractService
     */
    private $contractService;

    public function __construct(ContractService $contractService) {
        $this->name = 'provider';
        $this->description = __('module.provider.descriptionConfig');
        $this->icon = 'fas fa-file-export';
        $this->isActive = true;
        $this->place = ContractModulesAvailablePlace::FINISHER;
        $this->configComponent = 'ProviderConfigView';

        $actions = [];
        $actions['action-' . AvailableRenderActionsHook::AFTER_FORM_END] = 'ProviderForContractView';

        $this->setDefaultSettings([
            'type' => ContractProviderType::RENDER
        ]);
        $this->setHooksComponents($actions);
        $this->contractService = $contractService;
    }

    public function run(Contract $contract, int $partType, array $attributes = []) {
        parent::run($contract, $partType, $attributes);

        switch ($partType) {
            case ContractModulePart::RENDER_CONTRACT:
                return $this->renderContract();
            default:
                return false;
        }
    }

    private function renderContract() {
        /**
         * @var ContractFormComplete $formComplete
         */
        $formComplete = $this->getAttribute('formComplete');
        $renderType = $this->getModuleSettings('type');

        $contractPdfFile = $this->contractService
            ->renderContract( $this->contract->id, $formComplete->form_elements);

        $directory = "renders/contract-{$this->contract->id}/user-{$formComplete->user->id}/";
        $filePath = $directory . Str::random(16) . '.pdf';

        try {
            Storage::put($filePath, $contractPdfFile->output());

            if(!Storage::exists($filePath))
              throw new \Exception("File not found in $filePath");

            $formComplete->update([
                'status' => ContractFormCompleteStatus::AVAILABLE,
                'render_url' => '/storage/'.$filePath
            ]);

            switch ($renderType) {
                case ContractProviderType::EMAIL:
                    SendRenderEmail::dispatch($formComplete)
                      ->delay(Carbon::now()->addSeconds(5));
                    break;
                default:
                    return false;
            }
        }catch(Exception $e){
            $formComplete->update([
                'status' => ContractFormCompleteStatus::ERROR
            ]);
        }
    }
}
