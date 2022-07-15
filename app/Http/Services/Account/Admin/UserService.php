<?php

namespace App\Http\Services\Account\Admin;

use Spatie\Permission\Models\Role;
use App\Services\BaseService;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Image;

/**
 * Class UserService.
 */
class UserService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Model  $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }
	
	public function updateRole(array $data): User
    {
		$user = User::find($data['user_id']);
		
		//delete current user roles
		DB::delete("DELETE FROM model_has_roles WHERE model_type = :model_type AND model_id = :model_id", ['model_type' => "App\Models\User", 'model_id' => $user->id]);
		
		//insert user new roles assigned
		foreach($data['roles'] as $role) {
			$user->assignRole($role);
		}
		
		return $user;
	}
	
	public function updateProfile(array $data = []): User
    {
		$user = Auth::getUser();
		$user->first_name = $data['first_name'];
		$user->last_name = $data['last_name'];
		$user->email = $data['email'];
		$user->phone_number = $data['phone_number'];
		$user->date_of_birth = $data['date_of_birth'];
		$user->gender = $data['gender'];
		$user->save();
		
		return $user;
	}
	
	/**
	*@throws \Illuminate\Validation\ValidationException
	**/
	public function changePassword(array $data = []): User
	{
		$user = Auth::getUser();
		
		//confirm if current password is correct
		if (! Auth::guard('web')->validate([
            'id_number' => $user->id_number,
            'password' => $data['current_password'],
        ])) {
            throw ValidationException::withMessages([
                'current_password' => __('auth.password'),
            ]);
        }
		
		$user->forceFill([
                    'password' => Hash::make($data['new_password']),
                    'remember_token' => Str::random(60),
                ])->save();
		
		return $user;
	}
	
	public function changeProfilePhoto(string $profilePhotoPath = null): User
	{
		$user = Auth::getUser();
		
		$user->profile_photo = $this->getProfilePhotoName($profilePhotoPath);
        $user->save();
		
		return $user;
	}
	
	protected function getProfilePhotoName(string $uploadedProfilePhotoPath = null): string 
	{
		$profilePhotoPathArray = explode('/', $uploadedProfilePhotoPath);
		return $profilePhotoPathArray[count($profilePhotoPathArray) - 1];
	}
	
	public function deleteProfilePhoto(string $profilePhotoName = null)
	{
		if($profilePhotoName == null) return;
		
		if(Storage::exists('/public/profile-photos/original'.$profilePhotoName)) {
			Storage::delete('/public/profile-photos/original'.$profilePhotoName);
		}
		
		if(Storage::exists('/public/profile-photos/'.$profilePhotoName)) {
			Storage::delete('/public/profile-photos/'.$profilePhotoName);
		}
	}
	
	public function resizeProfilePhoto() {
		$user = Auth::getUser();
		$filename = $user['profile_photo'];
		
		$sourcePath = storage_path('app/public/profile-photos/original/');
		$destinationPath = storage_path('app/public/profile-photos/');
		$image = Image::make($sourcePath.$filename);
		$width = 256;
		$height = 256;
		
		$image->resize($width, $height, function ($constraint) {
			//$constraint->aspectRatio();
		})->save($destinationPath.$filename);
	}
}
