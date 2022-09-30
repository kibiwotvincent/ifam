<?php

namespace App\View\Components\Account\Farm;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Farm;

class FarmDepartment extends Component
{
	public $farm;
	public $department;
	public $read_only;
	public $page;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, $page = "farmer", $readOnly = false)
    {
		$this->farm = Farm::find($request->farm_id);
		$this->read_only = $readOnly;
		$this->page = $page;
		$this->department = $this->farm->departments->only([$request->department_id])->first();
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.farm-department');
    }
}
