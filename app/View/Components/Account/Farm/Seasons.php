<?php

namespace App\View\Components\Account\Farm;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Farm;

class Seasons extends Component
{
	public $farm;
	public $department;
	public $is_group;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, $isGroup = false)
    {
		$this->farm = Farm::find($request->farm_id);
		$this->is_group = $isGroup;
		$this->department = $this->farm->departments->only([$request->department_id])->first();
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.seasons');
    }
}
