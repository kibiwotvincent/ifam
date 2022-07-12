<?php

namespace App\Http\Services\Account\Admin;

use Spatie\Permission\Models\Permission;
use App\Services\BaseService;

/**
 * Class PermissionService.
 */
class PermissionService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Model  $permission
     */
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function store(array $data = []): Permission
    {
		$permission = Permission::create([
			'name' => $data['name']
		]);
		
        return  $permission;
    }
	
	public function delete(int $permissionID): Bool
    {
		return Permission::find($permissionID)->delete();
    }

}
