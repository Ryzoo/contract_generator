<?php

namespace App\Console\Commands;

use App\Core\Enums\ContractFormCompleteStatus;
use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Models\Domain\ContractFormComplete;
use App\Core\Services\Domain\ContractModuleService;
use Illuminate\Console\Command;

class ProcessContractRender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contract:render';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process one of the contract from list';
    /**
     * @var ContractModuleService
     */
    private $contractModuleService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ContractModuleService $contractModuleService)
    {
        parent::__construct();
        $this->contractModuleService = $contractModuleService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lastContractComplete = ContractFormComplete::with('contract')
            ->where('status', 'LIKE',ContractFormCompleteStatus::NEW)
            ->take(1)
            ->get();

        foreach ($lastContractComplete as $formComplete){
            $formComplete->update([
                'status' => ContractFormCompleteStatus::PENDING
            ]);

            $this->contractModuleService->runPart($formComplete->contract, ContractModulePart::RENDER_CONTRACT, [
                'formComplete' => $formComplete
            ]);
        }
    }
}
