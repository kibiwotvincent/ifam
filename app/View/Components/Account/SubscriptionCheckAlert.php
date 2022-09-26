<?php

namespace App\View\Components\Account;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class SubscriptionCheckAlert extends Component
{
	public $message;
	public $notSubscribed;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
		$user = Auth::user();
		$this->notSubscribed = $user->is_not_subscribed;
		$this->message = "Please subscribe to any of our plans to enjoy full features of iFam";	
		
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.subscription-check-alert');
    }
}
