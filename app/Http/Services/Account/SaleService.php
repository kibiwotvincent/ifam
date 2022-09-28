<?php

namespace App\Http\Services\Account;

use App\Models\Account\Sale;
use App\Services\BaseService;

/**
 * Class SaleService.
 */
class SaleService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Service  $sale
     */
    public function __construct(Sale $sale)
    {
        $this->model = $sale;
    }
	
	/**
     * Create a new sale record.
     *
     * @param  array
     * @return \App\Models\Account\Sale
     */
    public function store(array $data = []): Sale
    {
		$request = request();
		$saleReceiptCopy = null;
		if($request->hasfile('sale_receipt_copy')) {
			$filePath = $request->file('sale_receipt_copy')->store('public/'.Sale::SALE_RECEIPTS_FOLDER);
			$saleReceiptCopy = isset(explode('/', $filePath)[2]) ? explode('/', $filePath)[2] : null;
		}
		
		$sale = Sale::create([
			'season_id' => $data['season_id'],
			'description' => $data['description'],
			'quantity' => $data['quantity'],
			'unit_measure' => $data['unit_measure'],
			'quality' => $data['quality'],
			'expected_amount' => $data['expected_amount'],
			'sale_date' => $data['sale_date'],
			'sale_receipt_copy' => $saleReceiptCopy,
		]);
		
        return  $sale;
    }
	
	/**
     * Update sale record.
     *
     * @param  array
     * @return \App\Models\Account\Sale
     */
    public function update(array $data = []): Sale
    {
		$sale = Sale::find($data['sale_id']);
		
		$request = request();
		$saleReceiptCopy = null;
		//upload new sale receipt if it exists
		if($request->hasfile('sale_receipt_copy')) {
			$filePath = $request->file('sale_receipt_copy')->store('public/'.Sale::SALE_RECEIPTS_FOLDER);
			$saleReceiptCopy = isset(explode('/', $filePath)[2]) ? explode('/', $filePath)[2] : null;
			//delete existing sale receipt copy if it exists
			$this->deleteSaleReceiptCopy($sale->sale_receipt_copy);
		}
		
		//upload new payment receipt if it exists
		$paymentReceiptCopy = null;
		if($request->hasfile('payment_receipt_copy')) {
			$filePath = $request->file('payment_receipt_copy')->store('public/'.Sale::PAYMENT_RECEIPTS_FOLDER);
			$paymentReceiptCopy = isset(explode('/', $filePath)[2]) ? explode('/', $filePath)[2] : null;
			//delete existing payment receipt copy if it exists
			$this->deletePaymentReceiptCopy($sale->payment_receipt_copy);
		}
		
		$sale->description = $data['description'];
		$sale->quantity = $data['quantity'];
		$sale->unit_measure = $data['unit_measure'];
		$sale->quality = $data['quality'];
		$sale->expected_amount = $data['expected_amount'];
		$sale->sale_date = $data['sale_date'];
		if($saleReceiptCopy != null) {
			$sale->sale_receipt_copy = $saleReceiptCopy;
		}
		$sale->amount_paid = $data['amount_paid'];
		$sale->payment_date = $data['payment_date'];
		if($paymentReceiptCopy != null) {
			$sale->payment_receipt_copy = $paymentReceiptCopy;
		}
		$sale->payment_info = $data['payment_info'];
		$sale->save();
		
        return  $sale;
    }
	
	/**
     * Delete sale record.
     *
     * @param  int $saleID
     * @return bool
     */
    public function delete($saleID)
    {
		return Sale::find($saleID)->delete();
	}
	
	/**
     * Permanently delete sale record.
     *
     * @param  int $saleID
     * @return bool
     */
    public function destroy($saleID)
    {
		$sale = Sale::withTrashed()->find($saleID);
		
		$this->deleteSaleReceiptCopy($sale->sale_receipt_copy);
		$this->deletePaymentReceiptCopy($sale->payment_receipt_copy);
		
		return $sale->forceDelete();
	}
	
	/**
     * Restore deleted sale record.
     *
     * @param  int $saleID
     * @return bool
     */
    public function restore($saleID)
    {
		return Sale::withTrashed()->find($saleID)->restore();
	}
	
	/**
     * Delete sale receipt copy file if it exists
     *
     * @param  str $saleReceiptCopy
     * @return bool
     */
    public function deleteSaleReceiptCopy($saleReceiptCopy)
    {
		if($saleReceiptCopy != "" && Storage::exists('public/'.Sale::SALE_RECEIPTS_FOLDER.'/'.$saleReceiptCopy)){
			Storage::delete('public/'.Sale::SALE_RECEIPTS_FOLDER.'/'.$saleReceiptCopy);
		}
	}
	
	/**
     * Delete payment receipt copy file if it exists
     *
     * @param  str $paymentReceiptCopy
     * @return bool
     */
    public function deletePaymentReceiptCopy($paymentReceiptCopy)
    {
		if($paymentReceiptCopy != "" && Storage::exists('public/'.Sale::PAYMENT_RECEIPTS_FOLDER.'/'.$paymentReceiptCopy)){
			Storage::delete('public/'.Sale::PAYMENT_RECEIPTS_FOLDER.'/'.$paymentReceiptCopy);
		}
	}
	
}
