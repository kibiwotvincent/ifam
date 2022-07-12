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

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasFactory, SoftDeletes, HasRoles;//, Notifiable,  HasApiTokens;

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
        //'date_of_birth' => 'date',
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
		return 12;
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
    
}
