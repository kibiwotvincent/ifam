<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Admin\CreatePermissionRequest;
use App\Http\Requests\Account\Admin\DeletePermissionRequest;
use App\Http\Services\Account\Admin\PermissionService;
use App\Models\Account\Admin\Permission;
use Illuminate\Support\Facades\Response;

class PermissionController extends Controller
{
	
    protected $permissionService;

    /**
     * PermissionController constructor.
     *
     * @param  PermissionService $permissionService
	 * @return void
     */
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Handle an incoming create permission request.
     *
     * @param  \App\Http\Requests\Account\Admin\CreatePermissionRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(CreatePermissionRequest $request)
    {
		$this->permissionService->store($request->validated());
		
		// Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
		
		return Response::json(['message' => "Permission created successfully."], 200);
    }

    /**
     * Handle an incoming delete permission request.
     *
     * @param  \App\Http\Requests\Account\Admin\DeletePermissionRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function delete(DeletePermissionRequest $request)
    {
		$this->permissionService->delete($request->permission_id);
		
		// Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
		
		return Response::json(['message' => "Permission deleted successfully."], 200);
    }
}
