<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Response;
use App\Http\Requests\Roles\RoleUpdateRequest;
use App\Http\Requests\Roles\RoleAddRequest;
use App\Core\Services\RoleService;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;

class RoleController extends Controller
{
    /**
     * @var \App\Core\Services\RoleService
     */
    protected $roleService;

    public function __construct(RoleService $roleService) {
        $this->roleService = $roleService;
    }

    public function get(Request $request, int $id) {
        Response::success(Role::findOrFail($id));
    }

    public function getCollection(Request $request) {
        Response::success(Role::all());
    }

    public function add(RoleAddRequest $request) {
        $role = Role::create($request->validated());
        Response::success($role);
    }

    public function update(RoleUpdateRequest $request, int $id) {
        $roleModel = Role::findOrFail($id);
        $roleModel->update($request->validated());
        Response::success($roleModel);
    }

    public function remove(Request $request, int $id) {
        Response::success(Role::destroy($id));
    }
}
