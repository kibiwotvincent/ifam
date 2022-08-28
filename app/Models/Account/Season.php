<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Season extends Model
{
    use HasFactory, SoftDeletes;
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'farm_department_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'child_category_id',
        'child_sub_category_id',
        'acreage',
        'metadata',
        'status',
    ];
	
	/**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'metadata' => 'array',
        'deleted_at' => 'datetime',
    ];
	
	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [
		'start_date_string',
		'end_date_string',
	];
	
	/**
	 * Get start date as formated date string.
	 *
	 * @param  none
	 * @return string
	 */
	public function getStartDateStringAttribute()
	{
		return $this->start_date == "" ? "--" : date('d M Y', strtotime($this->start_date));
	}
	
	/**
	 * Get end date as formated date string.
	 *
	 * @param  none
	 * @return string
	 */
	public function getEndDateStringAttribute()
	{
		return $this->end_date == "" ? "--" : date('d M Y', strtotime($this->end_date));
	}
	
	/**
     * @var array Relations
     */
	public function expenses()
    {
        return $this->hasMany('App\Models\Account\Expense'::class);
    }
	
	/**
     * @var array Relations
     */
	public function sales()
    {
        return $this->hasMany('App\Models\Account\Sale'::class);
    }
	
	/**
     * @var array Relations
     */
	public function records()
    {
        return $this->hasMany('App\Models\Account\SeasonRecord'::class);
    }
	
	/**
     * @var array Relations
     */
	public function department()
    {
        return $this->belongsTo('App\Models\Account\FarmDepartment'::class, 'farm_department_id', 'id');
    }
	
	/**
     * @var array Relations
     */
	public function child_category()
    {
        return $this->hasOne('App\Models\Account\Admin\ChildCategory'::class, 'id', 'child_category_id');
    }
	
	/**
     * @var array Relations
     */
	public function child_sub_category()
    {
        return $this->hasOne('App\Models\Account\Admin\ChildSubCategory'::class, 'id', 'child_sub_category_id');
    }
	
	/**
     * @var array Relations
     */
	public function merged_group()
    {
        return $this->hasOne('App\Models\Account\GroupMergedSeason'::class);
    }
	
	/**
     * total sales of the season
     */
	public function total_sales($from = null, $to = null)
    {
        return $this->sales()->paid()->from($from)->to($to)->sum('amount_paid');
    }
	
	/**
     * total expenses of the season
     */
	public function total_expenses($from = null, $to = null)
    {
		return $this->expenses()->from($from)->to($to)->sum('amount');
	}
	
	/**
     * total profits of the season
     */
	public function total_profits($from = null, $to = null)
    {
		return $this->total_sales($from, $to) - $this->total_expenses($from, $to);
	}
	
	/**
	 * Query scope to only include seasons that belong to a particular department.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeDepartment($query, $departmentID)
	{
		if($departmentID !== null) {
			return $query->whereHas('department', function (Builder $query) use ($departmentID) {
						$query->where('department_id', $departmentID);
					});
		}
		
		return $query;
	}
	
	/**
	 * Query scope to only include seasons that belong to a particular child category.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeChildCategories($query, $childCategories)
	{
		if($childCategories !== null) {
			return $query->whereIn('child_category_id', $childCategories);
		}
		
		return $query;
	}
}
