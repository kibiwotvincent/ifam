<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;
	
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
		'status',
    ];
	
	/**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sale_date' => 'date:Y-m-d',
        'deleted_at' => 'datetime',
    ];
	
	/**
	 * Query scope to only include paid sales.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopePaid($query)
	{
		return $query->where('status', "paid");
	}
	
}
