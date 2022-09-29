<?php

namespace App\Policies;

use App\Models\Account\SeasonRecord;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeasonRecordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\SeasonRecord  $seasonRecord
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SeasonRecord $seasonRecord)
    {
		if($user->can('view any season record')) {
			return true;
		}
		
        $farm = $seasonRecord->season->department->farm;
		
		if($user->can('view season record') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			//check if user is allowed to view deleted season records - applies to when viewing deleted season record
			if($seasonRecord->trashed() && $user->cannot('view deleted season records')) return false;
			
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('view group season record')) {
				if($seasonRecord->trashed() && ! $member->can('view deleted group season records')) return false;
				
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\Season  $season
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Season $season)
    {
        $farm = $season->department->farm;
		
		if($user->can('add season record') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('add group season record')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\SeasonRecord  $seasonRecord
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SeasonRecord $seasonRecord)
    {
        $farm = $seasonRecord->season->department->farm;
		
		if($user->can('update season record') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('update group season record')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\SeasonRecord  $seasonRecord
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SeasonRecord $seasonRecord)
    {
        $farm = $seasonRecord->season->department->farm;
		
		if($user->can('delete season record') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('delete group season record')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\SeasonRecord  $seasonRecord
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SeasonRecord $seasonRecord)
    {
        $farm = $seasonRecord->season->department->farm;
		
		if($user->can('restore season record') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('restore group season record')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\SeasonRecord  $seasonRecord
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function destroy(User $user, SeasonRecord $seasonRecord)
    {
        $farm = $seasonRecord->season->department->farm;
		
		if($user->can('permanently delete season record') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('permanently delete group season record')) {
				return true;
			}
		}
		
		return false;
    }
}
