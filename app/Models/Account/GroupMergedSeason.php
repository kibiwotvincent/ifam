<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMergedSeason extends Model
{
    use HasFactory;
	
	public $timestamps = false;
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'season_id',
        'group_id',
        'group_member_id',
    ];
	
	/**
     * @var array Relations
     */
	public function group()
    {
        return $this->hasOne('App\Models\Account\Group'::class, 'id', 'group_id');
    }
	
	/**
     * @var array Relations
     */
	public function season()
    {
        return $this->belongsTo('App\Models\Account\Season'::class);
    }
}
