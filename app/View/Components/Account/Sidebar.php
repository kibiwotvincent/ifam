<?php

namespace App\View\Components\Account;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
	public $farmsCount;
	public $groupsCount;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
		$user = Auth::user();
		$this->farmsCount = $user->farms->count();
		$this->groupsCount = $user->groups()->accepted()->count();	
		
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.sidebar');
    }
}
