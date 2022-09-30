<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account\Admin\FarmCategory;
use App\Models\Account\Season;
use App\Models\Account\Expense;
use App\Models\Account\Sale;
use App\Http\Requests\Account\AddSeasonRequest;
use App\Http\Requests\Account\UpdateSeasonRequest;
use App\Http\Services\Account\SeasonService;
use App\Models\Account\Farm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class SeasonController extends Controller
{
	
    protected $seasonService;

    /**
     * SeasonController constructor.
     *
     * @param  SeasonService  $seasonService
	 * @return void
     */
    public function __construct(SeasonService $seasonService)
    {
        $this->seasonService = $seasonService;
    }
	
	
	/**
     * Display season view.
     *
     * @return \Illuminate\View\View
     */
    public function viewSeasonMeta(Request $request)
    {
		$season = Season::find($request->season_id);
		$farm = $season->department->farm;
        return view('account.admin.season', compact('season', 'farm'));
    }
	
}
