<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
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
        'amount',
        'date_incurred',
        'receipt_copy',
    ];
	
	/**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_incurred' => 'date:Y-m-d',
        'deleted_at' => 'datetime',
    ];
	
	/**
	 * Query scope to only include expenses incurred after or on a particular date.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeFrom($query, $dateIncurred = null)
	{
		if($dateIncurred !== null) {
			return $query->where('date_incurred', '>=', $dateIncurred);
		}
		
		return $query;
	}

	/**
	 * Query scope to only include expenses incurred before or on a particular date.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeTo($query, $dateIncurred = null)
	{
		if($dateIncurred !== null) {
			return $query->where('date_incurred', '<=', $dateIncurred);
		}
		
		return $query;
	}
	
}
