<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeasonRecord extends Model
{
    use HasFactory, SoftDeletes;
	
	const SEASON_RECORD_FILES_FOLDER = "season-record-files";
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'season_id',
        'title',
        'summary',
        'record_date',
    ];
	
	/**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
        'record_date' => 'date',
    ];
	
	/**
     * @var array Relations
     */
	public function season()
    {
        return $this->belongsTo('App\Models\Account\Season'::class);
    }
	
	/**
     * @var array Relations
     */
	public function files()
    {
        return $this->hasMany('App\Models\Account\SeasonRecordFile'::class);
    }
}
