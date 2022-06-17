<?php

namespace App\Http\Services\Account;

use App\Models\Account\Expense;
use App\Services\BaseService;

/**
 * Class ExpenseService.
 */
class ExpenseService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Service  $expense
     */
    public function __construct(Expense $expense)
    {
        $this->model = $expense;
    }
	
	/**
     * Create a new expense record.
     *
     * @param  array
     * @return \App\Models\Account\Expense
     */
    public function store(array $data = []): Expense
    {
		$expense = Expense::create([
			'season_id' => $data['season_id'],
			'description' => $data['description'],
			'amount' => $data['amount'],
			'date_incurred' => $data['date_incurred'],
		]);
		
        return  $expense;
    }

}
