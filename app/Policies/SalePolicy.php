<?php

namespace App\Policies;

use App\Models\Account\Season;
use App\Models\Account\Sale;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
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
     * @param  \Account\Sale  $sale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Sale $sale)
    {
		if($user->can('view any sale')) {
			return true;
		}
		
		$farm = $sale->season->department->farm;
		
		if($user->can('view sale') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			//check if user is allowed to view deleted sales - applies to when viewing deleted sale
			if($sale->trashed() && $user->cannot('view deleted sales')) return false;
			
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('view group sale')) {
				if($sale->trashed() && ! $member->can('view deleted group sales')) return false;
				
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
		
		if($user->can('add sale') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('add group sale')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Account\Sale  $sale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Sale $sale)
    {
        $farm = $sale->season->department->farm;
		
		if($user->can('update sale') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('update group sale')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Account\Sale  $sale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Sale $sale)
    {
        $farm = $sale->season->department->farm;
		
		if($user->can('delete sale') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('delete group sale')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Account\Sale  $sale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Sale $sale)
    {
        $farm = $sale->season->department->farm;
		
		if($user->can('restore sale') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('restore group sale')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Account\Sale  $sale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function destroy(User $user, Sale $sale)
    {
        $farm = $sale->season->department->farm;
		
		if($user->can('permanently delete sale') && $farm->isOwnedByFarmer && $farm->farmable_id == $user->id) {
			return true;
		}
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null && $member->can('permanently delete group sale')) {
				return true;
			}
		}
		
		return false;
    }
}
