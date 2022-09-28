<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;
	
	const SALE_RECEIPTS_FOLDER = "sale-receipts";
	const PAYMENT_RECEIPTS_FOLDER = "sale-payment-receipts";
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'season_id',
		'description',
		'quantity',
		'unit_measure',
		'quality',
		'expected_amount',
		'sale_date',
		'sale_receipt_copy',
    ];
	
	/**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sale_date' => 'date:Y-m-d',
        'payment_date' => 'date:Y-m-d',
        'deleted_at' => 'datetime',
    ];
	
	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [
		'status',
	];
	
	/**
	 * Get payment status of the sale.
	 *
	 * @param  none
	 * @return string
	 */
	public function getStatusAttribute()
	{
		return $this->amount_paid == "" ? "pending" : "paid";
	}
	
	/**
     * @var array Relations
     */
	public function season()
    {
        return $this->belongsTo('App\Models\Account\Season'::class);
    }
	
	/**
	 * Query scope to only include paid sales.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopePaid($query)
	{
		return $query->where('amount_paid', '!=', "");
	}
	
	/**
	 * Query scope to only include sales made after or on a particular date.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeFrom($query, $saleDate = null)
	{
		if($saleDate !== null) {
			return $query->where('sale_date', '>=', $saleDate);
		}
		
		return $query;
	}

	/**
	 * Query scope to only include sales made before or on a particular date.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeTo($query, $saleDate = null)
	{
		if($saleDate !== null) {
			return $query->where('sale_date', '<=', $saleDate);
		}
		
		return $query;
	}

}
