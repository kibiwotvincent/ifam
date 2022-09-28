<?php

namespace App\View\Components\Account\Farm\Season;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Season;
use Illuminate\Support\Facades\Auth;

class Sales extends Component
{
	public $season;
	public $sales;
	public $isGroup;
	public $readOnly;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, bool $isGroup, bool $readOnly)
    {
		$season = Season::find($request->season_id);
		$user = Auth::user();
		
		//get the farm which season belongs to
		$farm = $season->department->farm;
		
		$canViewDeletedSales = false;
		if($farm->farmable_type == 'App\Models\Account\Group') {
			$group = $farm->farmable;
			$member = $group->members()->where(['group_id' => $group['id'], 'user_id' => $user->id])->first();
			if($member != null && $member->can('view deleted group sales')) {
				$canViewDeletedSales = true;
			}
		}
		else {
			if($user->can('view deleted sales')) {
				$canViewDeletedSales = true;
			}
		}
		
		if($canViewDeletedSales) {
			//include deleted sales
			$sales = $season->sales()->withTrashed()->orderBy('sale_date', 'desc')->get();
		}
		else {
			//don't include deleted sales
			$sales = $season->sales()->orderBy('sale_date', 'desc')->get();
		}
		
		$this->season = Season::find($request->season_id);
		$this->sales = $sales;
		$this->isGroup = $isGroup;
		$this->readOnly = $readOnly;
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.season.sales');
    }
}
