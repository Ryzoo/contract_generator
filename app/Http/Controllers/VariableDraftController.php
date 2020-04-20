<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Response;
use App\Core\Models\Database\VariableDraft;
use App\Http\Requests\Attributes\VariableDraftAdd;
use App\Http\Requests\Attributes\VariableDraftDelete;
use App\Http\Requests\Attributes\VariableDraftUpdate;

class VariableDraftController extends Controller {
  public function get() {
    return Response::success(VariableDraft::all());
  }

  public function add(VariableDraftAdd $request) {
    $draft = VariableDraft::create($request->validated());
    return Response::success($draft->id);
  }

  public function delete(VariableDraftDelete $request, VariableDraft $draft) {
    $draft->forceDelete();
    return Response::success();
  }

  public function update(VariableDraftUpdate $request, VariableDraft $draft) {
    $draft->update($request->validated());
    $draft->save();
    return Response::success();
  }
}
