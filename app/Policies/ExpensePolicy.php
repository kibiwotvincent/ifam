<?php

namespace App\Policies;

use App\Models\Account\Season;
use App\Models\Account\Expense;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpensePolicy
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
		return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Account\Expense  $expense
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Expense $expense)
    {
        //get the farm 
		$farm = $expense->season->department->farm;
		
		if($user->can('view expense') && $farm->farmable_type == 'App\Models\User' && $farm->farmable_id == $user->id) {
			//user owns the farm which owns the season which the expenses is being updated
			//check if user can view deleted expense
			if(! $user->can('view deleted expenses')) return false;
			
			return true;
		}
		
		if($farm->farmable_type == 'App\Models\Account\Group') {
			//group owns the farm which owns the season which the expenses is being updated
			$group = $farm->farmable;
			$member = $group->members()->where(['group_id' => $group['id'], 'user_id' => $user->id])->first();
			if($member != null && $member->can('view group expense')) {
				if(! $member->can('view deleted group expenses')) return false;
				
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
        //get the farm 
		$farm = $season->department->farm;
		
		if($user->can('add expense') && $farm->farmable_type == 'App\Models\User' && $farm->farmable_id == $user->id) {
			//user owns the farm which owns the season which the expenses is being added
			return true;
		}
		
		if($farm->farmable_type == 'App\Models\Account\Group') {
			//group owns the farm which owns the season which the expenses is being added
			$group = $farm->farmable;
			$member = $group->members()->where(['group_id' => $group['id'], 'user_id' => $user->id])->first();
			if($member != null && $member->can('add group expense')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Account\Expense  $expense
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Expense $expense)
    {
        //get the farm 
		$farm = $expense->season->department->farm;
		
		if($user->can('update expense') && $farm->farmable_type == 'App\Models\User' && $farm->farmable_id == $user->id) {
			//user owns the farm which owns the season which the expenses is being updated
			return true;
		}
		
		if($farm->farmable_type == 'App\Models\Account\Group') {
			//group owns the farm which owns the season which the expenses is being updated
			$group = $farm->farmable;
			$member = $group->members()->where(['group_id' => $group['id'], 'user_id' => $user->id])->first();
			if($member != null && $member->can('update group expense')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Account\Expense  $expense
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Expense $expense)
    {
        //get the farm 
		$farm = $expense->season->department->farm;
		
		if($user->can('delete expense') && $farm->farmable_type == 'App\Models\User' && $farm->farmable_id == $user->id) {
			//user owns the farm which owns the season which the expense is being deleted
			return true;
		}
		
		if($farm->farmable_type == 'App\Models\Account\Group') {
			//group owns the farm which owns the season which the expense is being deleted
			$group = $farm->farmable;
			$member = $group->members()->where(['group_id' => $group['id'], 'user_id' => $user->id])->first();
			if($member != null && $member->can('delete group expense')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Account\Expense  $expense
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Expense $expense)
    {
        //get the farm 
		$farm = $expense->season->department->farm;
		
		if($user->can('restore expense') && $farm->farmable_type == 'App\Models\User' && $farm->farmable_id == $user->id) {
			//user owns the farm which owns the season which the expense is being restored
			return true;
		}
		
		if($farm->farmable_type == 'App\Models\Account\Group') {
			//group owns the farm which owns the season which the expense is being restored
			$group = $farm->farmable;
			$member = $group->members()->where(['group_id' => $group['id'], 'user_id' => $user->id])->first();
			if($member != null && $member->can('restore group expense')) {
				return true;
			}
		}
		
		return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Account\Expense  $expense
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function destroy(User $user, Expense $expense)
    {
        //get the farm 
		$farm = $expense->season->department->farm;
		
		if($user->can('permanently delete expense') && $farm->farmable_type == 'App\Models\User' && $farm->farmable_id == $user->id) {
			//user owns the farm which owns the season which the expense is being permanently deleted
			return true;
		}
		
		if($farm->farmable_type == 'App\Models\Account\Group') {
			//group owns the farm which owns the season which the expense is being permanently deleted
			$group = $farm->farmable;
			$member = $group->members()->where(['group_id' => $group['id'], 'user_id' => $user->id])->first();
			if($member != null && $member->can('permanently delete group expense')) {
				return true;
			}
		}
		
		return false;
    }
}
