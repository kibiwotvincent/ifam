<?php

namespace App\View\Components\Account\Farm;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Farm;
use \App\Models\Account\Season;

class MetaData extends Component
{
	public $expenses;
	public $sales;
	public $profit;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
		$farmID = $request->farm_id;
		
		$farm = Farm::find($farmID);
		$seasons = $farm->departments->only([$request->department_id])->first()->seasons;
		
		$expenses = 0;
		$sales = 0;
		
		foreach($seasons as $season) {
			$expenses += $season->expenses->sum('amount');
			$sales += $season->sales()->paid()->sum('amount_paid');
		}
        
		$this->expenses = number_format($expenses, 2);
        $this->sales = number_format($sales, 2);
        $this->profit = number_format(($sales - $expenses), 2);
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.meta_data');
    }
}
