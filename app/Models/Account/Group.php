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
	public function seasons($includeMergedSeasons = true) {
		$seasons = collect([]);
		//get group farms' seasons
		foreach($this->farms as $groupFarm) {
			foreach($groupFarm->departments as $farmDepartment) {
				foreach($farmDepartment->seasons as $season) {
					$seasons->push($season);
				}
			}
		}
		
		if($includeMergedSeasons) {
			//fetch group's merged seasons data
			$mergedSeasons = $this->merged_seasons;
			
			//push to seasons collection
			foreach($mergedSeasons as $mergedSeason) {
				$seasons->push($mergedSeason->season);
			}
		}
		
		return $seasons;
	}
	
	/*group crops*/
	public function interests(){
		$interests = [];
		foreach($this->seasons() as $season) {
			$interests[$season->child_category_id] = $season->child_category['name'];
		}
		return $interests;
	}
}
