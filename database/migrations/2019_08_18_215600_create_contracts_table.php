<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('contracts', static function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name');
      $table->text('description');
      $table->boolean('isAvailable')->default(false);
      $table->json('attributesList');
      $table->json('blocks');
      $table->json('settings');
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('contracts');
  }
}
