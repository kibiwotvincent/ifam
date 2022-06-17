<?php

namespace App\Models\Account\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmCategory extends Model
{
    use HasFactory, SoftDeletes;
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'category_order',
        'cover_photo',
        'metadata',
    ];
	
	/**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
		'metadata' => 'array',
        'deleted_at' => 'datetime',
    ];
	
	/**
     * @var array Relations
     */
	public function child_categories()
    {
        return $this->hasMany('App\Models\Account\Admin\ChildCategory'::class, 'parent_category_id', 'id');
    }

}
