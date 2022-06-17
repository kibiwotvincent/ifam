<?php

namespace App\View\Components\Account\Farm\Season;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Season;

class Expenses extends Component
{
	public $season;
	public $expenses;
	public $is_group;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, bool $isGroup = false)
    {
		$this->season = Season::find($request->season_id);
		$this->expenses = $this->season->expenses()->orderBy('date_incurred', 'desc')->get();
		$this->is_group = $isGroup;
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.season.expenses');
    }
}
