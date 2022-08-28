<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonRecordFile extends Model
{
    use HasFactory;
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'season_record_id',
        'name',
    ];
}
