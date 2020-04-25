<?php


namespace App\Core\Modules\Contract;


use App\Core\Enums\AvailableRenderActionsHook;
use App\Core\Enums\Modules\AuthType;
use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Enums\Modules\ContractModulesAvailablePlace;
use App\Core\Helpers\Response;
use App\Core\Models\Database\Contract;

class Auth extends ContractModule {

  public function __construct() {
    $this->slug = 'Auth';
    $this->name = __('module.auth.title');
    $this->description = __('module.auth.descriptionConfig');
    $this->icon = 'fas fa-unlock-alt';
    $this->isActive = TRUE;
    $this->place = ContractModulesAvailablePlace::PRE_FORM;
    $this->configComponent = 'AuthConfigView';
    $this->required = TRUE;
    $this->requirements = [
      Provider::class,
    ];

    $actions = [];
    $actions['action-' . AvailableRenderActionsHook::BEFORE_FORM_RENDER] = 'AuthBeforeRenderView';

    $this->setDefaultSettings([
      'type' => AuthType::LOGIN,
      'password' => '',
    ]);
    $this->setHooksComponents($actions);
  }

  public function run(Contract $contract, int $partType, array $attributes = []): bool {
    parent::run($contract, $partType, $attributes);

    switch ($partType) {
      case ContractModulePart::GET_CONTRACT:
        return $this->checkAuthorization();
      default:
        return TRUE;
    }
  }

  private function checkAuthorization(): bool {
    $authType = $this->getModuleSettings('type') ?? AuthType::LOGIN;

    switch ($authType) {
      case AuthType::LOGIN:
        if (\Illuminate\Support\Facades\Auth::user() != NULL) {
          return TRUE;
        }

        Response::error(__('response.notAuthorized'), 401);
        return FALSE;
      case AuthType::PASSWORD:
        $password = $this->getModuleSettings('password') ?? '';

        if ($this->getAttribute('password') === $password) {
          return TRUE;
        }

        Response::error(__('response.badPassword'), 400);
        return FALSE;
      default:
        return FALSE;
    }
  }

  protected function preventSettingsShow(?array $settings): array {
    $settings = parent::preventSettingsShow($settings);
    return $settings;
  }
}
