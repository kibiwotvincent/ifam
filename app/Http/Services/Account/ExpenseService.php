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
		$request = request();
		$receiptCopy = null;
		if($request->hasfile('receipt_copy')) {
			$filePath = $request->file('receipt_copy')->store('public/expense-receipts');
			$receiptCopy = isset(explode('/', $filePath)[2]) ? explode('/', $filePath)[2] : null;
		}
		
		$expense = Expense::create([
			'season_id' => $data['season_id'],
			'description' => $data['description'],
			'amount' => $data['amount'],
			'date_incurred' => $data['date_incurred'],
			'receipt_copy' => $receiptCopy,
		]);
		
        return  $expense;
    }
	
	/**
     * Update expense record.
     *
     * @param  array
     * @return \App\Models\Account\Expense
     */
    public function update(array $data = []): Expense
    {
		$request = request();
		$receiptCopy = null;
		if($request->hasfile('receipt_copy')) {
			$filePath = $request->file('receipt_copy')->store('public/expense-receipts');
			$receiptCopy = isset(explode('/', $filePath)[2]) ? explode('/', $filePath)[2] : null;
			//delete existing receipt copy if it exists
		}
		
		$expense = Expense::find($data['expense_id']);
		$expense->description = $data['description'];
		$expense->amount = $data['amount'];
		$expense->date_incurred = $data['date_incurred'];
		if($receiptCopy != null) {
			$expense->receipt_copy = $receiptCopy;
		}
		$expense->save();
		
        return  $expense;
    }
	
	/**
     * Delete expense record.
     *
     * @param  int $expenseID
     * @return bool
     */
    public function delete($expenseID)
    {
		return Expense::find($expenseID)->delete();
	}
	
	/**
     * Permanently delete expense record.
     *
     * @param  int $expenseID
     * @return bool
     */
    public function destroy($expenseID)
    {
		return Expense::withTrashed()->find($expenseID)->forceDelete();
	}
	
	/**
     * Restore deleted expense record.
     *
     * @param  int $expenseID
     * @return bool
     */
    public function restore($expenseID)
    {
		return Expense::withTrashed()->find($expenseID)->restore();
	}

}
