<?php

namespace App\Http\Controllers\Contract;

use App\Core\Helpers\Response;
use App\Core\Models\Database\Category;
use App\Core\Models\Database\Contract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryRemoveRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;

class CategoryController extends Controller {

  public function index() {
    Response::json(Category::all());
  }

  public function store(CategoryCreateRequest $request) {
    Response::json(Category::create($request->validated()));
  }

  public function show(Category $category) {
    Response::json($category);
  }

  public function update(CategoryUpdateRequest $request, Category $category) {
    $category->fill($request->validated());
    $category->save();
    Response::json($category);
  }

  public function destroy(CategoryRemoveRequest $request, Category $category) {
    $category->delete();
  }
}
