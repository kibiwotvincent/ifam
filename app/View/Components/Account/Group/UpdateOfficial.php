<?php

namespace App\View\Components\Account\Group;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Group;

class UpdateOfficial extends Component
{
	public $group;
	public $position;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request, $position)
    {
		$this->group = Group::find($request->id);
		$this->position = $position;
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.group.update-official');
    }
}
