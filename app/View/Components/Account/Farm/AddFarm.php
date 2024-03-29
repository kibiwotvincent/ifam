<?php

namespace App\View\Components\Account\Farm;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Admin\FarmCategory;

class AddFarm extends Component
{
	public $owner;
	public $ownerID;
	public $farmCategories;
	
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
		$this->ownerID = $ownerID;
		$this->farmCategories = FarmCategory::orderBy('name', 'asc')->get();
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.add_farm');
    }
}
