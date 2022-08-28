<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Account\AddSeasonRecordRequest;
use App\Http\Services\Account\SeasonRecordService;
use \App\Models\Account\Season;

class SeasonRecordController extends Controller
{
    protected $seasonRecordService;

    /**
     * SeasonRecordController constructor.
     *
     * @param  SeasonRecordService  $seasonRecordService
	 * @return void
     */
    public function __construct(SeasonRecordService $seasonRecordService)
    {
        $this->seasonRecordService = $seasonRecordService;
    }
	
	/**
     * Display the add season record view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
		$season = Season::find($request->season_id);
		$view = ($request->routeIs('group.*')) ? 'account.group.add-season-record' : 'account.add-season-record';
		
        return view($view, ['season' => $season]);
    }
	
	/**
     * Handle an incoming add season record request.
     *
     * @param  \App\Http\Requests\Account\AddSeasonRecordRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddSeasonRecordRequest $request)
    {
		$this->seasonRecordService->store($request->validated());
		return Response::json(['message' => "Season record added successfully."], 200);
    }
}
