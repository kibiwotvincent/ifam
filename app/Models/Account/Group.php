<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Account\Season;

class Group extends Model
{
    use HasFactory, SoftDeletes;
	const GROUP_MODEL_NAME = 'App\Models\Account\Group';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_by',
        'name',
        'logo',
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
     * @var array Relations
     */
	public function members()
    {
        return $this->hasMany('App\Models\Account\GroupMember'::class);
    }
	
	/**
     * @var array Relations
     */
	public function merged_seasons()
    {
        return $this->hasMany('App\Models\Account\GroupMergedSeason'::class);
    }
	
	/**
	 * Get all of the group's farms.
	 */
	public function farms()
	{
		return $this->morphMany('App\Models\Account\Farm'::class, 'farmable');
	}
	
	/*get group seasons, this includes merged seasons from members by default*/
	public function seasons($includeMergedSeasons = true, $department = null, $categories = null) {
		
		$seasons = Season::whereHas('department.farm.farmable')
					->join('farm_departments', 'seasons.farm_department_id', '=', 'farm_departments.id')
					->join('farms', 'farm_departments.farm_id', '=', 'farms.id')
					->join('groups', 'farms.farmable_id', '=', 'groups.id')
					->where('farms.farmable_type', self::GROUP_MODEL_NAME)
					->where('groups.id', $this->id)
					->department($department)
					->childCategories($categories)
					->select('seasons.*')
					->get();
		
		if($includeMergedSeasons) {
			//fetch group's merged seasons data
			$mergedSeasons = $this->merged_seasons()->department($department)->childCategories($categories)->get()
								->map(function($mergedSeason){
									return $mergedSeason->season;
								});
								
			//merge seasons
			$seasons = $seasons->concat($mergedSeasons);
		}
		
		return $seasons;
	}
	
	/*group interests - basically categories of group seasons including merged seasons*/
	public function interests() {
		return $this->seasons()
				->mapWithKeys(function($season){
					return [$season->child_category_id => $season->child_category['name']];
				})->toArray();
	}
	
	//returns group unique departments - from farm category table
	//basically go through all seasons belonging to the group including merged seasons if specified
	//then return unique farm categories as group departments
	public function departments($includeMergedSeasons = true) {
		return $this->seasons($includeMergedSeasons)
				->map(function($season){
					return $season->department->category;
				})->unique('id');
	}
	
	//return group unique categories - from child category table
	public function categories($includeMergedSeasons = true) {
		$categories = $this->departments($includeMergedSeasons)->map(function($category){
							return $category->child_categories->map(function($childCategory){
								return $childCategory;
							});
						})->flatten()->unique('id');
						
		return $categories;
	}
}
