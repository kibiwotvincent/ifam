<?php

namespace App\View\Components\Account\Farm;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Admin\FarmCategory;
use \App\Models\Account\Farm;

class AddFarm extends Component
{
	public $owner;
	public $owner_id;
	public $farm_categories;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
		if($request->routeIs('group.*')) {
			$owner = 'group';
			$ownerID = $request->group_id;
		}
		else {
			$owner = 'individual';
			$ownerID = $request->user()->id;
		}
		
		$this->owner =  $owner;
		$this->owner_id = $ownerID;
		$this->farm_categories = FarmCategory::orderBy('name', 'asc')->get();
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.add-farm');
    }
}
