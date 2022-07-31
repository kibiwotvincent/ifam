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
use Illuminate\Support\Facades\Validator;
use \Carbon\Carbon;

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
     * Display farmer report view.
     *
     * @return \Illuminate\View\View
     */
    public function farmer_report(Request $request)
    {
		$user = $request->user();
		$seasons = $user->seasons();
					
		$departments = $seasons->map(function($season){
							return $season->department->category;
						})->unique('id');
		
		$categories = $departments->map(function($category){
							return $category->child_categories->map(function($childCategory){
								return $childCategory;
							});
						})->flatten()->unique('id');
		
		$data = ['farmer' => $user, 'seasons' => $seasons, 'departments' => $departments, 'categories' => $categories, 'from' => null, 'to' => null];
		
        return view('account.farmer_report', $data);
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
	
	/**
     * Display farmer report.
     *
     * @return \Illuminate\View\View
     */
    public function fetch_farmer_report(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
            'department' => ['nullable', 'numeric'],
            'categories' => ['required', 'array'],
		]);
		
		$validator->after(function ($validator) use ($request) {
			if ($request->from != null && $request->to != null) {
				$from = new Carbon($request->from);
				$to = new Carbon($request->to);
				
				//extra validate `from` date only if `to` date exists
				//`from` date must be before or equals to `to` date
				if($from->gt($to)) {
					$validator->errors()->add(
						'from', "The from must be a date before or equal to to."
					);
				}
				
				//extra validate `to` date only if `from` date exists
				//`to` date must come after or equals to `from` date
				if($to->lt($from)) {
					$validator->errors()->add(
						'from', "The to must be a date after or equal to from."
					);
				}
			}
		});
		
		if ($validator->fails()) {
			//get the first error message
			$errorMessage = $validator->errors()->all()[0];
			
			return response()
					->view('components.common.alert', ['type' => "danger", 'message' => $errorMessage], 200)
					->header('Content-Type', "text/html; charset=UTF-8");
		}
		
		$user = User::find($request->user_id);
		$viewData = ['seasons' => $user->seasons($request->department, $request->categories), 'from' => $request->from, 'to' => $request->to];
		
		return response()
			->view('components.account.farm.farmer_report_table', $viewData, 200)
			->header('Content-Type', "text/html; charset=UTF-8");
    }
}
