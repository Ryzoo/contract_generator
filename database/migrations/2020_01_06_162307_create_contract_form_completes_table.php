<?php

use App\Core\Enums\ContractFormCompleteStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractFormCompletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_form_completes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('contract_id');
            $table->json('form_elements');
            $table->enum('status',[ContractFormCompleteStatus::NEW, ContractFormCompleteStatus::PENDING, ContractFormCompleteStatus::AVAILABLE, ContractFormCompleteStatus::DELIVERED])
                ->default(ContractFormCompleteStatus::NEW);
            $table->string('render_url')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_form_completes');
    }
}
