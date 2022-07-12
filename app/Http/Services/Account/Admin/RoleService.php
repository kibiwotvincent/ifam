<?php

namespace App\Http\Services\Account\Admin;

use Spatie\Permission\Models\Role;
use App\Services\BaseService;

/**
 * Class RoleService.
 */
class RoleService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Model  $role
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function store(array $data = []): Role
    {
		$role = Role::create([
			'name' => $data['name']
		]);
		
        return  $role;
    }
	
	public function update(int $roleID, array $data = []): Role
    {
		$role = Role::find($roleID);
		$role->syncPermissions($data['permissions']);
		return $role;
	}

	public function delete(int $roleID): Bool
    {
		return Role::find($roleID)->delete();
	}
}
