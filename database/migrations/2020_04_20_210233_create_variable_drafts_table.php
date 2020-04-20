<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariableDraftsTable extends Migration {

  public function up() {
    Schema::create('variable_drafts', static function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name');
      $table->string('description');
      $table->string('category');
      $table->text('content');
      $table->timestamps();
    });
  }

  public function down() {
    Schema::dropIfExists('variable_drafts');
  }
}
