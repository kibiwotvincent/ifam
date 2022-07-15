<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Account\Admin\UserService;
use App\Http\Requests\Account\Admin\UpdateUserRoleRequest;
use App\Http\Requests\Account\UpdateProfileRequest;
use App\Http\Requests\Account\ChangePasswordRequest;
use App\Http\Requests\Account\ChangeProfilePhotoRequest;
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
     * Display the user profile view.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
		$user = Auth::getUser();
        return view('account.profile', compact('user'));
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
	
	/**
     * Handle an incoming update profile request.
     *
     * @param  \App\Http\Requests\Account\UpdateProfileRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateProfileRequest $request)
    {
		$this->userService->updateProfile($request->validated());
		return Response::json(['message' => "Profile updated successfully."], 200);
    }
	
	/**
     * Handle an incoming change password request.
     *
     * @param  \App\Http\Requests\Account\ChangePasswordRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function changePassword(ChangePasswordRequest $request)
    {
		$this->userService->changePassword($request->validated());
		
		//terminate session
		Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
		
		return Response::json(['message' => "Password updated successfully. Login with your new password."], 200);
    }
	
	/**
     * Handle an incoming change profile photo request.
     *
     * @param  \App\Http\Requests\Account\ChangeProfilePhotoRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function changeProfilePhoto(ChangeProfilePhotoRequest $request)
    {
		$user = Auth::getUser();
		$existingProfilePhoto = $user['profile_photo'];
		
		$profilePhotoPath = $request->file('profile_photo')->store('public/profile-photos/original');
		$this->userService->changeProfilePhoto($profilePhotoPath);
		
		//resize uploaded profile photo
		$this->userService->resizeProfilePhoto();
		
		//delete previous profile photo
		$this->userService->deleteProfilePhoto($existingProfilePhoto);
		
		return Response::json(['message' => "Profile photo updated successfully."], 200);
	}
}
