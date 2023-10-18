<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Account\Season;

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
	 * Get farm owner.
	 *
	 * @param  none
	 * @return string
	 */
	public function getOwnerAttribute()
	{
		return ($this->farmable_type == self::GROUP_MODEL_NAME) ? "group" : "individual";
	}
	
	/**
	 * Check if farm is owned by farmer.
	 *
	 * @param  none
	 * @return bool
	 */
	public function getIsOwnedByFarmerAttribute()
	{
		return $this->farmable_type == self::USER_MODEL_NAME;
	}
	
	/**
	 * Check if farm is owned by group.
	 *
	 * @param  none
	 * @return bool
	 */
	public function getIsOwnedByGroupAttribute()
	{
		return $this->farmable_type == self::GROUP_MODEL_NAME;
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
	
	/*get all seasons belonging to the farm*/
	public function seasons($department = null, $categories = null) {
		$seasons = Season::whereHas('department.farm')
					->join('farm_departments', 'seasons.farm_department_id', '=', 'farm_departments.id')
					->join('farms', 'farm_departments.farm_id', '=', 'farms.id')
					->where('farms.id', $this->id)
					->department($department)
					->childCategories($categories)
					->select('seasons.*')
					->get();
		
		return $seasons;
	}

}
