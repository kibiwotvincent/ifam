<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Laravel\Sanctum\HasApiTokens;
//use App\Notifications\VerifyEmailAddress;
//use App\Notifications\PasswordReset;
use App\Models\Account\Season;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasFactory, SoftDeletes, HasRoles;//, Notifiable,  HasApiTokens;
	
	const USER_MODEL_NAME = 'App\Models\User';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'id_number',
        'phone_number',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'phone_number_verified_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'deleted_at' => 'datetime',
        'date_of_birth' => 'date',
		'subscription_expires_on' => 'datetime',
    ];
	
	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [
		'full_name',
		'name',
		'age',
		'is_not_subscribed',
	];
	
	/**
	 * Get user's name.
	 *
	 * @param  none
	 * @return string
	 */
	public function getNameAttribute()
	{
		return $this->first_name." ".$this->last_name;
	}
	
	/**
	 * Get user age.
	 *
	 * @param  none
	 * @return string
	 */
	public function getAgeAttribute()
	{
		if($this->date_of_birth == "") return null;
		
		$today = \Carbon\Carbon::now();
		$age = $today->diffInYears($this->date_of_birth);

		return $age;
	}
	
	/**
	 * Get user full name.
	 *
	 * @param  none
	 * @return string
	 */
	public function getFullNameAttribute()
	{
		return $this->first_name." ".$this->last_name;
	}
	
	/**
	 * Get whether user is on an active paid plan or not.
	 *
	 * @param  none
	 * @return boolean
	 */
	public function getIsNotSubscribedAttribute()
	{	
		//check if user is allowed to bypass subscription check
		if($this->can('bypass subscription check')) return false;
		
		$now = \Carbon\Carbon::now();
		return $this->subscription_expires_on == "" || $now->gt($this->subscription_expires_on);
	}
	
	/**
     * @var array Relations
     */
	public function groups()
    {
        return $this->hasMany('App\Models\Account\GroupMember'::class);
    }
	
	/**
	 * Get all of the user's farms.
	 */
	public function farms()
	{
		return $this->morphMany('App\Models\Account\Farm'::class, 'farmable');
	}

	/*public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailAddress($this));
    }
	public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token, $this));
    }*/
	
	/**
	 * Get all of seasons belonging to user farms.
	 */
	public function seasons($department = null, $categories = null)
	{
		$seasons = Season::whereHas('department.farm.farmable')
					->join('farm_departments', 'seasons.farm_department_id', '=', 'farm_departments.id')
					->join('farms', 'farm_departments.farm_id', '=', 'farms.id')
					->join('users', 'farms.farmable_id', '=', 'users.id')
					->where('farms.farmable_type', self::USER_MODEL_NAME)
					->where('users.id', $this->id)
					->department($department)
					->childCategories($categories)
					->select('seasons.*')
					->get();
		
		return $seasons;
	}
    
}
