<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmDepartment extends Model
{
    use HasFactory, SoftDeletes;
	
	public $timestamps = false;
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'farm_id',
        'department_id',
    ];
	
	/**
     * @var array Relations
     */
	public function farm()
    {
        return $this->belongsTo('App\Models\Account\Farm'::class);
    }

	/**
     * @var array Relations
     */
	public function category()
    {
        return $this->hasOne('App\Models\Account\Admin\FarmCategory'::class, 'id', 'department_id');
    }
	
	/**
     * @var array Relations
     */
	public function seasons()
    {
        return $this->hasMany('App\Models\Account\Season'::class);
    }
	
	/**
     * get department expenses
     */
	public function expenses()
    {
		$expenses = 0;
		foreach($this->seasons as $season) {
			$expenses += $season->expenses->sum('amount');
		}
        return $expenses;
    }
	
	/**
     * get department sales
     */
	public function sales()
    {
		$sales = 0;
		foreach($this->seasons as $season) {
			$sales += $season->sales()->paid()->sum('amount_paid');
		}
        return $sales;
    }
	
	/**
     * get department profits
     */
	public function profits()
    {
		return $this->sales() - $this->expenses();
	}
}
