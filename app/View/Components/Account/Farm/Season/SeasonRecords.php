<?php

namespace App\View\Components\Account\Farm\Season;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Season;

class SeasonRecords extends Component
{
	public $season;
	public $records;
	public $is_group;
	public $read_only;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, bool $isGroup = false, bool $readOnly = false)
    {
		$this->season = Season::find($request->season_id);
		$this->records = $this->season->records()->orderBy('record_date', 'DESC')->get();
		$this->is_group = $isGroup;
		$this->read_only = $readOnly;
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.season.records');
    }
}
