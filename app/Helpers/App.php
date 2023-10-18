<?php

namespace App\Helpers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class App
{
    /**
     * Available permissions grouped into roles.
     *
     * @var array
     */
    protected $permissions = [
        'system admin' => [
                            'bypass subscription check',
                            'add roles and permissions','view roles and permissions','update roles and permissions','delete roles and permissions',
                            'add farm categories','view farm categories','update farm categories','delete farm categories','restore farm categories','permanently delete farm categories',
                            'view users','view farmers','view groups reports','view farms','view deleted farms','view groups',
                            'view groups report',
                            'view any expense',
                            'view any sale',
                            'view any season record',
                            'view any season',
                          ],
        'farmer' => [
                        'add farm','view farm','update farm','delete farm','restore farm','permanently delete farm',
                        'add sale','view sale','update sale','delete sale','restore sale','permanently delete sale','view deleted sale',
                        'add expense','view expense','update expense','delete expense','restore expense','permanently delete expense','view deleted expense',
                        'add season','view season','update season','delete season','restore season','permanently delete season','view deleted season',
                        'add season record','view season record','update season record','delete season record','restore season record','permanently delete season record','view deleted season record',
                        'add group','view group',
                        'add farm department','view farm department','update farm department'
                    ],
        'group treasurer' => [
                        'add group sale','update group sale','delete group sale','restore group sale','permanently delete group sale',
                        'add group expense','update group expense','delete group expense','restore group expense','permanently delete group expense','view deleted group expense',
                        'view deleted group sale'
                    ],
        'group secretary' => [
                        'add group season record','update group season record','delete group season record','restore group season record','permanently delete group season record','view deleted group season record',
                        'add group season','update group season','delete group season','restore group season','permanently delete group season','view deleted group season',
                    ],
        'group chairman' => [
                        'delete group','restore group','permanently delete group',
                        'add group farm','update group farm','delete group farm','restore group farm','permanently delete group farm',
                        'view deleted group farm',
                    ],
        'group member' => [
                        'view group farm','view group season','view group season record','view group sale','view group expense',  
                    ],
    ];

    /**
     * Save and set permissions for each available roles.
     *
     * @return void
     */
    public function setPermissions()
    {
        //delete current available roles and permissions
        Role::query()->delete();
        Permission::query()->delete();
        
        // Reset cached roles and permissions
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        //save new roles and permissions
        foreach($this->permissions as $roleName => $rolePermissions) {
            $savedRolePermissions = [];
            foreach($rolePermissions as $permissionName) {
                $permission = Permission::create(['name' => $permissionName, 'guard_name' => 'web']);
                array_push($savedRolePermissions, $permission->id);
            }
		    $role = Role::create(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($savedRolePermissions);
        }
        
        // Reset cached roles and permissions
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
    
    /**
     * Save details of admin being created. i.e email and password.
     *
     * @return void
     */
    public function saveAdminDetails($detail, $value)
    {
        session([$detail => $value]);
    }
    
    /**
     * Confirm entered admin password if it match.
     *
     * @return boolean
     */
    public function confirmAdminPassword($password)
    {
        return (session('admin_password') === $password);
    }
    
    /**
     * Save admin details to the database.
     *
     * @param  none
     * @return boolean
     */
    public function createAdmin()
    {
		$email = session('admin_email');
        $password = session('admin_password');
        
        $admin = User::create([
					'email' => $email,
					'password' => Hash::make($password),
				]);
			
        $admin->assignRole('system admin');
        $admin->assignRole('farmer');
        
        // Reset cached roles and permissions
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        return $admin->hasRole('system admin');
    }
}
