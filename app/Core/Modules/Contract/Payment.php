<?php


namespace App\Core\Modules\Contract;

use App\Core\Enums\ContractAdditionalActionType;
use App\Core\Enums\ContractFormCompleteStatus;
use App\Core\Enums\Modules\ContractModulesAvailablePlace;
use App\Core\Models\Database\ContractFormComplete;
use App\Core\Providers\Przelewy24Provider;
use App\Core\Enums\AvailableRenderActionsHook;
use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Models\Database\Contract;
use Illuminate\Support\Facades\Lang;

class Payment extends ContractModule
{
    public function __construct()
    {
        $this->slug = 'Payment';
        $this->name = __('module.payment.title');
        $this->description = __('module.payment.descriptionConfig');
        $this->icon = 'fas fa-dollar-sign';
        $this->isActive = TRUE;
        $this->place = ContractModulesAvailablePlace::FINISHER;
        $this->configComponent = 'PaymentConfigView';
        $this->required = TRUE;

        $actions = [];
        $actions['action-' . AvailableRenderActionsHook::AFTER_FORM_END] = 'PaymentForContractView';

        $this->setDefaultSettings([
            'amount' => 0,
            'description' => 'Płatność za umowę',
            'currency' => 'PLN',
            'country' => 'PL',
        ]);
        $this->setHooksComponents($actions);
    }

    public function run(Contract $contract, int $partType, array $attributes = []): bool
    {
        parent::run($contract, $partType, $attributes);

        switch ($partType) {
            case ContractModulePart::AFTER_END_CONTRACT:
                return $this->preparePayment();
            default:
                return FALSE;
        }
    }

    private function preparePayment(): ?bool
    {
        /**
         * @var ContractFormComplete $formComplete
         */
        $formComplete = $this->getAttribute('formComplete');

        $formComplete->update([
            'status' => ContractFormCompleteStatus::WAIT_FOR_ACTION,
            'action_details' => json_encode([
                'action_type' => ContractAdditionalActionType::PAYMENT,
                'payment_url' => '',
                'verify_data' => [],
                'payment_is_pending' => true,
            ], JSON_THROW_ON_ERROR),
        ]);

        $user = $formComplete->user;
        $amount = (int) $this->getModuleSettings('amount') * 100.0;
        $currency = $this->getModuleSettings('currency');
        $description = $this->getModuleSettings('description');
        $country = $this->getModuleSettings('country');
        $language = Lang::getLocale();

        $payment = new Przelewy24Provider($formComplete->id, $user, $amount, $currency, $description, $country, $language);

        try {
            $payment = $payment->preparePayment();

            $formComplete->update([
                'action_details' => json_encode([
                    'action_type' => ContractAdditionalActionType::PAYMENT,
                    'payment_url' => $payment['url'],
                    'verify_data' => $payment['verify'],
                    'payment_is_pending' => true,
                ], JSON_THROW_ON_ERROR),
            ]);
        }catch (\Exception $e){
            $formComplete->update([
                'status' => ContractFormCompleteStatus::ERROR,
            ]);
        }

        return true;
    }
}
