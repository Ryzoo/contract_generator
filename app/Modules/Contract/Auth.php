<?php


namespace App\Modules\Contract;


use App\Enums\AvailableRenderActionsHook;
use App\Enums\Modules\AuthType;
use App\Enums\Modules\ContractModulePart;
use App\Helpers\Response;
use App\Models\Domain\Contract;

class Auth extends ContractModule {

    public function __construct() {
        $this->name = "auth";

        $actions = [];
        $actions["action-".AvailableRenderActionsHook::BEFORE_FORM_RENDER] = "AuthBeforeRenderView";

        $this->setHooksComponents($actions);
    }

    public function run(Contract &$contract, int $partType, array $attributes = []) {
        parent::run($contract, $partType, $attributes);

        switch ($partType){
            case ContractModulePart::GET_CONTRACT:
                return $this->checkAuthorization();
            default:
                return true;
        }
    }

    private function checkAuthorization(): bool{
        $authType = $this->getModuleSettings("type") ?? AuthType::ALL;

        switch ($authType){
            case AuthType::LOGIN:
                $loggedUser = resolve("AppAuthorization")->getCurrentUser();

                if($loggedUser != null)
                    return true;
                else{
                    Response::error("Musisz być zalogowany, żeby przeglądać ten formularz", 401);
                    return false;
                }
            case AuthType::PASSWORD:
                $password = $this->getModuleSettings("password") ?? "";

                if($this->getAttribute('password') === $password)
                    return true;
                else{
                    Response::error("Niepoprawne hasło!", 400);
                    return false;
                }
            default:
                return true;
        }
    }

    protected function preventSettingsShow(?array $settings): array{
        $settings = parent::preventSettingsShow($settings);

        $settings["password"] = "****";

        return $settings;
    }
}
