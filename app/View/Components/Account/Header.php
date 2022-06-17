<?php

namespace App\View\Components\Account;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Header extends Component
{
	public $user;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->user = Auth::user();
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.header');
    }
}
