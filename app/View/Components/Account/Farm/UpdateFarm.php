<?php

namespace App\View\Components\Account\Farm;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Admin\FarmCategory;
use \App\Models\Account\Farm;

class UpdateFarm extends Component
{
	public $farm;
	public $farmCategories;
	public $farmDepartmentsIDs;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, Farm $farm)
    {
		$farmDepartmentsIDs = $farm->departments->map(function($row) {
															return $row->department_id;
														})->toArray();
		
		$this->farm =  $farm;
		$this->farmCategories = FarmCategory::orderBy('name', 'asc')->get();
		$this->farmDepartmentsIDs = $farmDepartmentsIDs;
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.update_farm');
    }
}
