<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

class GroupMember extends Model
{
    use HasFactory;
	
	const POSITIONS = ['chairperson', 'treasurer', 'secretary', 'member'];
	const STATUS = ['invited', 'pending', 'accepted', 'removed'];
	const DEFAULT_POSITION = 'member';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'user_id',
        'position',
        'status',
    ];
	
	/**
	 * The "booted" method of the model.
	 *
	 * @return void
	 */
	protected static function booted()
	{
		static::addGlobalScope('accepted', function (Builder $builder) {
			$builder->where('status', 'accepted');
		});
	}
	
	/**
     * @var array Relations
     */
	public function user()
    {
        return $this->hasOne('App\Models\User'::class, 'id', 'user_id');
    }

	/**
     * @var array Relations
     */
	public function group()
    {
        return $this->hasOne('App\Models\Account\Group'::class, 'id', 'group_id');
    }
	
	/**
	 * Query scope to only include user's accepted groups.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeAccepted($query)
	{
		return $query->where('status', "accepted");
	}
	
	/**
	 * Query scope to only include groups whose join request is pending.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopePending($query)
	{
		return $query->withoutGlobalScope('accepted')->where('status', "pending");
	}
	
	/**
	 * Query scope to only include groups which user has been removed.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeRemoved($query)
	{
		return $query->withoutGlobalScope('accepted')->where('status', "removed");
	}
	
	/**
	 * Query scope to only include groups whose join request is pending or where user has been accepted.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeAcceptedOrPending($query)
	{
		return $query->withoutGlobalScope('accepted')->where('status', "pending")->orWhere('status', "accepted");
	}
	
	/**
	 * Query scope to only include groups whose join request is pending or where user has been accepted.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeWithNotAccepted($query)
	{
		return $query->withoutGlobalScope('accepted');
	}
	
	/**
	 * Check if member join request has been accepted
	 *
	 * @param  none
	 * @return bool
	 */
	public function isAccepted()
	{
		return $this->status == "accepted";
	}
	
	/**
	 * Query scope for chairperson.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeChairperson($query)
	{
		return $query->where('position', "chairperson");
	}
	
	/**
	 * Query scope for secretary.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeSecretary($query)
	{
		return $query->where('position', "secretary");
	}
	
	/**
	 * Query scope for treasurer.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeTreasurer($query)
	{
		return $query->where('position', "treasurer");
	}
	
	/**
     * @var array Relations
     */
	public function merged_seasons()
    {
        return $this->hasMany('App\Models\Account\GroupMergedSeason'::class, 'group_member_id', 'id');
    }
	
	/**
     * @var array Relations
	 * group member contributions
     */
	public function contributions()
    {
        return $this->hasMany('App\Models\Account\Contribution'::class);
    }
	
	/*get group member merged seasons*/
	public function mergedSeasons($department = null, $categories = null) {
		$seasons = $this->merged_seasons()->department($department)->childCategories($categories)->get()
					->map(function ($row) {
						return $row->season;
					});
		
		return $seasons;
	}
	
	//returns group member unique departments - from farm category table
	//basically go through all merged seasons of the member
	//then return unique farm categories as departments
	public function departments() {
		return $this->merged_seasons
				->map(function($row){
					return $row->season->department->category;
				})->unique('id');
	}
	
	//return group member unique categories - from child category table
	public function categories() {
		$categories = $this->departments()->map(function($category){
							return $category->child_categories->map(function($childCategory){
								return $childCategory;
							});
						})->flatten()->unique('id');
						
		return $categories;
	}
	
	/*get group member grouped contributions*/
	public function grouped_contributions($year, $month, $groupBy = 'month') {
		$contributions = self::contributions()
						->where('target_year', $year)
						->where('target_month', $month)
						->get()
						->groupBy($groupBy);
						
		return $contributions;
	}
	
	/**
	 * Query member permissions as per their group position.
	 *
	 * @param  String  $permission
	 * @return Boolean
	 */
	public function can($permission) {
		//get member position i.e chairperson/treasurer/secretary/member and fetch allocated position permissions from db
		//get permissions for the member position
		//check if permissions allocated to member can allow `$permission`
		//this prevents permissions gained from another group to be used in another group
		
		$role = Role::where('name', ucfirst(strtolower($this->position)))->first();
		
		if($role != null) {
			$rolePermissions = $role->permissions->map(function ($row) {
									return $row['name'];
								})->all();
								
			if(in_array($permission, $rolePermissions)) {
				//member has the permission being checked
				return true;
			}
		}
		
		return false;
	}
	
}
