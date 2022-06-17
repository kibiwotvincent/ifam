<?php

namespace App\Http\Controllers\Account;

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
     * Display the add season view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
		$farm = Farm::find($request->farm_id);
		$department = $farm->departments->only([$request->department_id])->first();
		
		$view = ($request->routeIs('group.*')) ? 'account.group.add-season' : 'account.add-season';
		
        return view($view, compact('farm', 'department'));
    }
	
	/**
     * Display farms view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
		$user = Auth::user();
		$farms = Farm::where(['owner' => "individual", 'owner_id' => $user->id])->orderBy('name', 'asc')->get();
        return view('account.farms', compact('farms'));
    }
	
	/**
     * Display season view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$season = Season::find($request->season_id);
		$view = ($request->routeIs('group.*')) ? 'account.group.season' : 'account.season';
		
        return view($view, compact('season'));
    }
	
	/**
     * Display update season view.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
		$season = Season::find($request->season_id);
		$farm = Farm::find($request->farm_id);
		$view = ($request->routeIs('group.*')) ? 'account.group.update-season' : 'account.update-season';
		
        return view($view, compact('season', 'farm'));
    }

    /**
     * Handle an incoming add season request.
     *
     * @param  \App\Http\Requests\Account\AddSeasonRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddSeasonRequest $request)
    {
		$this->seasonService->store($request->validated());
		return Response::json(['message' => "Season added successfully."], 200);
    }

    /**
     * Handle an incoming update season request.
     *
     * @param  \App\Http\Requests\Account\UpdateSeasonRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateSeasonRequest $request)
    {
		$this->seasonService->update($request->validated());
		return Response::json(['message' => "Season updated successfully."], 200);
    }
}
