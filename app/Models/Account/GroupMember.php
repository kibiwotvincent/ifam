<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;
	
	const POSITIONS = ['chairperson', 'treasurer', 'secretary', 'member'];
	const STATUS = ['invited', 'pending', 'accepted'];
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
		return $query->accepted()->where('position', "chairperson");
	}
	
	/**
	 * Query scope for secretary.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeSecretary($query)
	{
		return $query->accepted()->where('position', "secretary");
	}
	
	/**
	 * Query scope for treasurer.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeTreasurer($query)
	{
		return $query->accepted()->where('position', "treasurer");
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
	
}
