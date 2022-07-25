<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class GroupMergedSeason extends Model
{
    use HasFactory;
	
	public $timestamps = false;
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'season_id',
        'group_id',
        'group_member_id',
    ];
	
	/**
     * @var array Relations
     */
	public function group()
    {
        return $this->hasOne('App\Models\Account\Group'::class, 'id', 'group_id');
    }
	
	/**
     * @var array Relations
     */
	public function season()
    {
        return $this->belongsTo('App\Models\Account\Season'::class);
    }
	
	/**
	 * Query scope to only include merged seasons that belong to a particular department.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeDepartment($query, $departmentID)
	{
		if($departmentID !== null) {
			return $query->whereHas('season.department', function (Builder $query) use ($departmentID) {
						$query->where('department_id', $departmentID);
					});
		}
		
		return $query;
	}
	
	/**
	 * Query scope to only include merged seasons that belong to a particular child category.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeChildCategories($query, $childCategories)
	{
		if($childCategories !== null) {
			
			return $query->whereHas('season', function (Builder $query) use ($childCategories) {
						$query->whereIn('child_category_id', $childCategories);
					});
			
		}
		
		return $query;
	}
}
