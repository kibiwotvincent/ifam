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
	public $canAddSale;
	public $canViewSale;
	public $canUpdateSale;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
		$season = Season::find($request->season_id);
		$user = Auth::user();
		
		//get the farm which season belongs to
		$farm = $season->department->farm;
		
		$canViewDeletedSales = false;
		$canAddSale = false;
		$canViewSale = false;
		$canUpdateSale = false;
		
		if($farm->isOwnedByGroup) {
			$member = $farm->farmable->members()->where('user_id', $user->id)->first();
			if($member != null) {
				$canAddSale = $member->can('add group sale');
				$canViewSale = $member->can('view group sale');
				$canUpdateSale = $member->can('update group sale');
				$canViewDeletedSales = $member->can('view deleted group sales');
			}
		}
		else {
			$canAddSale = $user->can('add sale');
			$canViewSale = $user->can('view sale');
			$canUpdateSale = $user->can('update sale');
			$canViewDeletedSales = $user->can('view deleted sales');
		}
		
		if($canViewDeletedSales) {
			//include deleted sales
			$sales = $season->sales()->withTrashed()->orderBy('sale_date', 'desc')->get();
		}
		else {
			//don't include deleted sales
			$sales = $season->sales()->orderBy('sale_date', 'desc')->get();
		}
		
		if($canViewSale == false) {
			//check allow if user is allowed to view any sale
			$canViewSale = $user->can('view any sale');
		}
		
		$this->season = Season::find($request->season_id);
		$this->sales = $sales;
		$this->isGroup = $farm->isOwnedByGroup;
		$this->canAddSale = $canAddSale;
		$this->canViewSale = $canViewSale;
		$this->canUpdateSale = $canUpdateSale;
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
