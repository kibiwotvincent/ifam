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
		$sale = Sale::create([
			'season_id' => $data['season_id'],
			'description' => $data['description'],
			'quantity' => $data['quantity'],
			'unit_measure' => $data['unit_measure'],
			'quality' => $data['quality'],
			'expected_amount' => $data['expected_amount'],
			'sale_date' => $data['sale_date'],
			//'sale_receipt_copy' => $data['sale_receipt_copy'],
			'status' => 'pending',
		]);
		
        return  $sale;
    }
	
}
