<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Farm extends Model
{
    use HasFactory, SoftDeletes;
	
	const OWNERS = ['individual','group'];
	const GROUP_MODEL_NAME = 'App\Models\Account\Group';
	const USER_MODEL_NAME = 'App\Models\User';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'farmable_type',
        'farmable_id',
        'name',
        'description',
        'acreage',
        'location',
        'category_id',
    ];
	
	/**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];
	
	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [
		'owner',
	];
	
	/**
	 * Get user name.
	 *
	 * @param  none
	 * @return string
	 */
	public function getOwnerAttribute()
	{
		return ($this->farmable_type == self::GROUP_MODEL_NAME) ? "group" : "individual";
	}
	
	/**
     * @var array Relations
     */
	public function departments()
    {
        return $this->hasMany('App\Models\Account\FarmDepartment'::class);
    }
	
	/**
	 * Get the parent farmable model (user or group).
	 */
	public function farmable()
	{
		return $this->morphTo();
	}

}
