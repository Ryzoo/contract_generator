<?php


namespace App\Core\Modules\Contract;


use App\Core\Enums\AvailableRenderActionsHook;
use App\Core\Enums\Modules\AuthType;
use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Enums\Modules\ContractModulesAvailablePlace;
use App\Core\Helpers\Response;
use App\Core\Models\Domain\Contract;

class Auth extends ContractModule {

    public function __construct() {
        $this->name = 'auth';
        $this->description = __('module.auth.descriptionConfig');
        $this->icon = 'fas fa-unlock-alt';
        $this->isActive = true;
        $this->place = ContractModulesAvailablePlace::PRE_FORM;
        $this->configComponent = 'AuthConfigView';

        $actions = [];
        $actions['action-' .AvailableRenderActionsHook::BEFORE_FORM_RENDER] = 'AuthBeforeRenderView';

        $this->setDefaultSettings([
            'type' => AuthType::LOGIN,
            'password' => ''
        ]);
        $this->setHooksComponents($actions);
    }

    public function run(Contract $contract, int $partType, array $attributes = []) {
        parent::run($contract, $partType, $attributes);

        switch ($partType){
            case ContractModulePart::GET_CONTRACT:
                return $this->checkAuthorization();
            default:
                return true;
        }
    }

    private function checkAuthorization(): bool{
        $authType = $this->getModuleSettings('type') ?? AuthType::LOGIN;

        switch ($authType){
            case AuthType::LOGIN:
                if( \Illuminate\Support\Facades\Auth::user() != null)
                    return true;
                else{
                    Response::error(__('response.notAuthorized'), 401);
                    return false;
                }
            case AuthType::PASSWORD:
                $password = $this->getModuleSettings("password") ?? '';

                if($this->getAttribute('password') === $password)
                    return true;
                else{
                    Response::error(__('response.badPassword'), 400);
                    return false;
                }
            default:
                return false;
        }
    }

    protected function preventSettingsShow(?array $settings): array{
        $settings = parent::preventSettingsShow($settings);
        return $settings;
    }
}
