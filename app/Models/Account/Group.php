<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;
	
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
		$seasons = collect([]);
		//get group farms' seasons
		foreach($this->farms as $farm) {
			foreach($farm->seasons($department, $categories) as $season) {
				$seasons->push($season);
			}
		}
		
		if($includeMergedSeasons) {
			//fetch group's merged seasons data
			$mergedSeasons = $this->merged_seasons()->department($department)->childCategories($categories)->get();
			
			//push to seasons collection
			foreach($mergedSeasons as $mergedSeason) {
				$seasons->push($mergedSeason->season);
			}
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
		$categories = collect([]);
		foreach($this->departments($includeMergedSeasons) as $category) {
			foreach($category->child_categories as $row) {
				$categories->push($row);				
			}
		}
		
		return $categories->unique('id');
	}
}
