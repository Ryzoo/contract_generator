<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Response;
use App\Http\Requests\Roles\RoleUpdateRequest;
use App\Http\Requests\Roles\RoleAddRequest;
use App\Core\Services\RoleService;
use App\Http\Requests\Users\RoleDeleteRequest;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Permission;
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
        $role = Role::with('permissions')->findOrFail($id);
        Response::success($role);
    }

    public function getCollection(Request $request) {
        Response::success(Role::all());
    }

    public function add(RoleAddRequest $request) {
        $requestData = $request->validated();
        $roleModel = Role::create($requestData);
        $roleModel->syncPermissions($requestData['permission']);
        Response::success($roleModel);
    }

    public function update(RoleUpdateRequest $request, int $id) {
        $requestData = $request->validated();
        $roleModel = Role::findOrFail($id);
        $roleModel->update($requestData);
        $roleModel->syncPermissions($requestData['permission']);
        Response::success($roleModel);
    }

    public function remove(RoleDeleteRequest $request, int $id) {
        Response::success(Role::destroy($id));
    }

    public function getPermission(Request $request) {
        Response::success(Permission::all());
    }
}
