<?php

namespace App\Policies;

use App\Models\Account\FarmDepartment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FarmDepartmentPolicy
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
     * @param  \App\Models\Account\FarmDepartment  $farmDepartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FarmDepartment $farmDepartment)
    {
        if($user->can('view any farm department')) {
			return true;
		}
		
		$farm = $farmDepartment->farm;
		
		if($user->can('view farm department') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			if($farmDepartment->trashed() && $user->cannot('view deleted farm department')) return false;
			
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('view group farm department')) {
				if($farmDepartment->trashed() && ! $member->can('view deleted group farm department')) return false;
				
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\FarmDepartment  $farmDepartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FarmDepartment $farmDepartment)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\FarmDepartment  $farmDepartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FarmDepartment $farmDepartment)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\FarmDepartment  $farmDepartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FarmDepartment $farmDepartment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account\FarmDepartment  $farmDepartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FarmDepartment $farmDepartment)
    {
        //
    }
}
