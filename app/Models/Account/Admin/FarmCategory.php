<?php

namespace App\Models\Account\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmCategory extends Model
{
    use HasFactory, SoftDeletes;
	
	const METADATAS = 	[
							['acreage' => ['label' => "Acreage", 'input' => "text", 'validation' => "nullable|numeric"]],
							['planting_date' => ['label' => "Planting Date", 'input' => "date", 'validation' => "required|date"], 'stocking_date' => ['label' => "Stocking Date", 'input' => "date", 'validation' => "required|date"]],
						];
	
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

	/**
     * get metadatas as a single dimension array
     */
	public function getMetadatas()
    {
        return collect(self::METADATAS)->collapse();
    }
}
