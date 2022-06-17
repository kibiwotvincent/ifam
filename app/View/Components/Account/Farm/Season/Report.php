<?php

namespace App\View\Components\Account\Farm\Season;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use \App\Models\Account\Season;
use Illuminate\Support\Arr;

class Report extends Component
{
	public $sales_and_expenses;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
		$season = Season::find($request->season_id);
						
		$sales = $season->sales()
						->addSelect('sale_date as date', 'amount_paid as amount', 'description')
						->paid()
						->get();
						
		$expenses = $season->expenses()
						->addSelect('date_incurred as date', 'amount', 'description')
						->get();
		
		$rows = [];
		foreach($sales as $row) {
			$row['type'] = "sale";
			array_push($rows, $row);
		}
		foreach($expenses as $row) {
			$row['type'] = "expense";
			array_push($rows, $row);
		}
		
		//sort using date
		$sorted = array_values(Arr::sort($rows, function ($value) {
			return $value['date'];
		}));
		
		$reversed = [];
		for($i = count($sorted)-1; $i >= 0; $i--) {
			$reversed[] = $sorted[$i];
		}
		
		$this->sales_and_expenses = $reversed;
		
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.season.report');
    }
}
