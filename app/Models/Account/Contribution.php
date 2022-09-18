<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contribution extends Model
{
    use HasFactory, SoftDeletes;
	
	const YEARS = [2020, 2030];
	const MONTHS = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'];
	const PAYMENT_MODES = ['cash' => 'Cash', 'mpesa' => "Mpesa"];
	const MINIMUM_AMOUNT = 50;
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_member_id',
        'target_year',
        'target_month',
        'amount',
        'date_received',
        'payment_mode',
        'transaction_info',
    ];
	
	/**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
        'date_received' => 'date',
    ];
	
	/**
	 * Query scope to only fetch contributions for a certain year.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeYear($query, $year)
	{
		return $query->where('target_year', $year);
	}
	
	/**
	 * Query scope to only fetch contributions for a certain month - to be chained with year scope.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeMonth($query, $month)
	{
		return $query->where('target_month', $month);
	}
	
}
