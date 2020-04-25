<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Response;
use App\Core\Models\Database\VariableDraft;
use App\Http\Requests\Attributes\VariableDraftAdd;
use App\Http\Requests\Attributes\VariableDraftDelete;
use App\Http\Requests\Attributes\VariableDraftUpdate;

class VariableDraftController extends Controller {
  public function get() {
    Response::success(VariableDraft::all());
  }

  public function add(VariableDraftAdd $request) {
    $draft = VariableDraft::create($request->validated());
    Response::success($draft->id);
  }

  public function delete(VariableDraftDelete $request, VariableDraft $draft) {
    $draft->forceDelete();
    Response::success();
  }

  public function update(VariableDraftUpdate $request, VariableDraft $draft) {
    $draft->update($request->validated());
    $draft->save();
    Response::success();
  }
}
