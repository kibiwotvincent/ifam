<?php

namespace App\View\Components\Account\Farm;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Farm;
use Illuminate\Support\Facades\Auth;

class ViewFarm extends Component
{
	public $farm;
	public $canDelete;
	public $canRestore;
	public $canDestroy;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, Farm $farm)
    {
		$user = Auth::user();
		
		$canDelete = false;
		$canRestore = false;
		$canDestroy = false;
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null) {
				$canDelete = $member->can('delete group farm');
				$canRestore = $member->can('restore group farm');
				$canDestroy = $member->can('permanently delete group farm');
			}
		}
		else {
			$canDelete = $user->can('delete farm');
			$canRestore = $user->can('restore farm');
			$canDestroy = $user->can('permanently delete farm');
		}
		
		$this->farm = $farm;
		$this->canDelete = $canDelete;
		$this->canRestore = $canRestore;
		$this->canDestroy = $canDestroy;
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.view_farm');
    }
}
