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
	
	/*get group seasons, this includes merged seasons from members by default*/
	/*public function seasons() {
		$seasons = [];
		//get group farms' seasons
		foreach($this->farms as $groupFarm) {
			foreach($groupFarm->departments as $farmDepartment) {
				$seasons = $farmDepartment->seasons;
			}
		}
		
		//fetch group's merged seasons data
		$mergedSeasons = $this->merged_seasons;
		
		//push to seasons collection
		foreach($mergedSeasons as $mergedSeason) {
			$seasons->push($mergedSeason->season);
		}
		return $seasons;
	}*/
	
}
