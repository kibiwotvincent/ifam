<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Account\Admin\UserService;
use App\Http\Requests\Account\Admin\UpdateUserRoleRequest;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
	
    protected $userService;

    /**
     * UserController constructor.
     *
     * @param  UserService  $userService
	 * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
	
    /**
     * Display the users view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
		$users = User::orderBy('first_name', 'asc')->get();
		$roles = Role::orderBy('name', 'asc')->get();
		
        return view('account.admin.users', compact('users', 'roles'));
    }
	
	/**
     * Display the farmers view.
     *
     * @return \Illuminate\View\View
     */
    public function farmers()
    {
		$farmers = User::orderBy('first_name', 'asc')->get()->filter(function($user) {
						return $user->hasRole('Farmer');
					});
		
        return view('account.admin.farm.farmers', compact('farmers'));
    }
	
	/**
     * Display the farmer view.
     *
     * @return \Illuminate\View\View
     */
    public function farmer(Request $request)
    {
		$farmer = User::find($request->user_id);
		$groups = $farmer->groups->filter(function($member) { 
						return $member->isAccepted();
					});
        return view('account.admin.farm.farmer', compact('farmer','groups'));
    }
	
	/**
     * Handle an incoming update user role request.
     *
     * @param  \App\Http\Requests\Account\Admin\UpdateUserRoleRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function updateRole(UpdateUserRoleRequest $request)
    {
		$this->userService->updateRole($request->validated());
		
		// Reset cached roles and permissions
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
		
		return Response::json(['message' => "User roles updated successfully."], 200);
    }
}
