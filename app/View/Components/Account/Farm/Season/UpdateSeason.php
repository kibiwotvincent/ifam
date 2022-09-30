<?php

namespace App\View\Components\Account\Farm\Season;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use App\Models\Account\Season;
use Illuminate\Support\Facades\Auth;

class UpdateSeason extends Component
{
	/**
     * season
     *
     * @var model
     */
    public $season;
    public $childSubCategories;
    public $userGroups;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, bool $isGroup = false)
    {
        $this->season = Season::find($request->season_id);
		$this->isGroup = $isGroup;
		$this->childSubCategories = $this->season->child_category->child_sub_categories()->orderBy('name', 'asc')->get();
		$this->userGroups = Auth::user()->groups;
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.season.update-season');
    }
}
