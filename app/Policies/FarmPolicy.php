<?php

namespace App\Policies;

use App\Models\Account\Farm;
use App\Models\Account\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FarmPolicy
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
     * @param  \App\Models\Account\Farm  $farm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Farm $farm)
    {
        if($user->can('view any farm')) {
			return true;
		}
		
		if($user->can('view farm') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			if($farm->trashed() && $user->cannot('view deleted farms')) return false;
			
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('view group farm')) {
				if($farm->trashed() && ! $member->can('view deleted group farms')) return false;
				
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  bool  $isOwnedByGroup
     * @param  \App\Models\Account\Group  $group
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, $isOwnedByGroup, Group $group = null)
    {
		if($isOwnedByGroup) {
			$member = $group->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('add group farm')) {
				return true;
			}
		}
		else {
			if($user->can('add farm')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\Farm  $farm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Farm $farm)
    {
		if($farm->isOwnedByFarmer && $farm->farmable_id == $user->id && $user->can('update farm')) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('update group farm')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\Farm  $farm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Farm $farm)
    {
        if($user->can('delete farm') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('delete group farm')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\Farm  $farm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Farm $farm)
    {
        if($user->can('restore farm') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('restore group farm')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\Farm  $farm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function destroy(User $user, Farm $farm)
    {
        if($user->can('permanently delete farm') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('permanently delete group farm')) {
				return true;
			}
		}
		
		return false;
    }
}
