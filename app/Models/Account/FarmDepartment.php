<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmDepartment extends Model
{
    use HasFactory;
	
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
}
