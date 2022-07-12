<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Admin\CreateRoleRequest;
use App\Http\Requests\Account\Admin\UpdateRoleRequest;
use App\Http\Requests\Account\Admin\DeleteRoleRequest;
use App\Http\Services\Account\Admin\RoleService;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
	
    protected $roleService;

    /**
     * RoleController constructor.
     *
     * @param  RoleService $roleService
	 * @return void
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
	
	/**
     * Display roles and permissions view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
		$permissions = Permission::orderBy('name', 'ASC')->get();
		$roles = Role::orderBy('name', 'ASC')->get();
        return view('account.admin.roles', compact('permissions', 'roles'));
    }
	
	/**
     * Display role view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$permissions = Permission::orderBy('name', 'ASC')->get();
		$role = Role::find($request->id);
		
		$role_permissions = $role->permissions->map(function ($row) {
								return $row['name'];
							})->all();
		
        return view('account.admin.role', compact('permissions', 'role', 'role_permissions'));
    }
	
    /**
     * Handle an incoming create role request.
     *
     * @param  \App\Http\Requests\Account\Admin\CreateRoleRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(CreateRoleRequest $request)
    {
		$this->roleService->store($request->validated());
		
		// Reset cached roles and permissions
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
		
		return Response::json(['message' => "Role created successfully."], 200);
    }
	
	/**
     * Handle an incoming update role request.
     *
     * @param  \App\Http\Requests\Account\Admin\UpdateRoleRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateRoleRequest $request)
    {
		$this->roleService->update($request->id, $request->validated());
		
		// Reset cached roles and permissions
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
		
		return Response::json(['message' => "Role updated successfully."], 200);
    }
	
	/**
     * Handle an incoming delete role request.
     *
     * @param  \App\Http\Requests\Account\Admin\DeleteRoleRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function delete(DeleteRoleRequest $request)
    {
		$this->roleService->delete($request->role_id);
		
		// Reset cached roles and permissions
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
		
		return Response::json(['message' => "Role deleted successfully."], 200);
    }
    
}
