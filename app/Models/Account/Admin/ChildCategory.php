<?php

namespace App\Models\Account\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChildCategory extends Model
{
    use HasFactory, SoftDeletes;
	
	const METADATAS = 	[
							['unit_measure' => ['label' => "Unit Measure", 'input' => "select", 'validation' => "nullable", 'type' => "repeater", 'attributes' => ['code','name']]],
							['quality' => ['label' => "Quality", 'input' => "select", 'validation' => "nullable", 'type' => "repeater", 'attributes' => ['code','name']]],
						];
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'parent_category_id',
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
	public function child_sub_categories()
    {
        return $this->hasMany('App\Models\Account\Admin\ChildSubCategory'::class, 'parent_category_id', 'id');
    }
	
	/**
     * @var array Relations
     */
	public function parent_category()
    {
        return $this->belongsTo('App\Models\Account\Admin\FarmCategory'::class, 'id', 'parent_category_id');
    }
	
	/**
     * get metadatas as a single dimension array
     */
	public function getMetadatas()
    {
        return collect(self::METADATAS)->collapse();
    }

}
