<?php

namespace App\Policies;

use App\Models\Account\Season;
use App\Models\Account\FarmDepartment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeasonPolicy
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
     * @param  \App\Models\Account\Season  $season
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Season $season)
    {
        if($user->can('view any season')) {
			return true;
		}
		
		$farm = $season->department->farm;
		
		if($user->can('view season') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			if($season->trashed() && $user->cannot('view deleted seasons')) return false;
			
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('view group season')) {
				if($season->trashed() && ! $member->can('view deleted group seasons')) return false;
				
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\FarmDepartment  $department
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, FarmDepartment $department)
    {
        $farm = $department->farm;
		
		if($user->can('add season') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('add group season')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\Season  $season
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Season $season)
    {
        $farm = $season->department->farm;
		
		if($user->can('update season') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('update group season')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\Season  $season
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Season $season)
    {
        $farm = $season->department->farm;
		
		if($user->can('delete season') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('delete group season')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\Season  $season
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Season $season)
    {
        $farm = $season->season->department->farm;
		
		if($user->can('restore season') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('restore group season')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\Season  $season
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Season $season)
    {
        $farm = $sale->season->department->farm;
		
		if($user->can('permanently delete season') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('permanently delete group season')) {
				return true;
			}
		}
		
		return false;
    }

}
