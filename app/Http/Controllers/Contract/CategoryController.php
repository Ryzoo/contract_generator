<?php

namespace App\Http\Controllers\Contract;

use App\Core\Helpers\Response;
use App\Core\Models\Domain\Category;
use App\Core\Models\Domain\Contract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryRemoveRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;

class CategoryController extends Controller
{
    public function index()
    {
        Response::json(Category::all());
    }

    public function store(CategoryCreateRequest $request)
    {
        Response::json(Contract::create($request->validated()));
    }

    public function show(Category $contractCategory)
    {
        Response::json($contractCategory);
    }

    public function update(CategoryUpdateRequest $request, Category $contractCategory)
    {
        $contractCategory->fill($request->validated());
        Response::json($contractCategory);
    }

    public function destroy(CategoryRemoveRequest $request,Category $contractCategory)
    {
        $contractCategory->delete();
    }
}
