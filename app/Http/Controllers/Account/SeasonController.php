<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Season;
use App\Http\Requests\Account\AddSeasonRequest;
use App\Http\Requests\Account\UpdateSeasonRequest;
use App\Http\Requests\Account\DeleteSeasonRequest;
use App\Http\Requests\Account\RestoreSeasonRequest;
use App\Http\Services\Account\SeasonService;
use App\Models\Account\FarmDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
		$farmDepartment = FarmDepartment::find($request->department_id);
		$this->authorize('create', [Season::class, $farmDepartment]);
		
		$department = $farmDepartment;
		$farm = $farmDepartment->farm;
		$view = ($request->routeIs('group.*')) ? 'account.group.add-season' : 'account.add-season';
		
        return view($view, compact('farm', 'department'));
    }
	
	/**
     * Display season view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$season = Season::withTrashed()->find($request->season_id);
		$this->authorize('view', $season);
		
		$view = ($request->routeIs('group.*')) ? 'account.group.view_season' : 'account.view_season';
		
        return view($view, compact('season'));
    }
	
	/**
     * Display season page - expenses, sales & records.
     *
     * @return \Illuminate\View\View
     */
    public function season(Request $request)
    {
		$season = Season::withTrashed()->find($request->season_id);
		$this->authorize('view', $season);
		
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
		$season = Season::findOrFail($request->season_id);
		$this->authorize('update', $season);
		
		$farm = $season->farm;
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
		$farmDepartment = FarmDepartment::find($request->department_id);
		$this->authorize('create', [Season::class, $farmDepartment]);
		
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
		$season = Season::find($request->season_id);
		$this->authorize('update', $season);
		
		$this->seasonService->update($request->validated());
		return Response::json(['message' => "Season updated successfully."], 200);
    }
	/**
     * Handle an incoming delete season request.
     *
     * @param  \App\Http\Requests\Account\DeleteSeasonRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function delete(DeleteSeasonRequest $request)
    {
		$season = Season::find($request->season_id);
		$this->authorize('delete', $season);
		
		$this->seasonService->delete($request->validated()['season_id']);
		return Response::json(['message' => "Season deleted successfully."], 200);
    }
	
	/**
     * Handle an incoming restore deleted season request.
     *
     * @param  \App\Http\Requests\Account\RestoreSeasonRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function restore(RestoreSeasonRequest $request)
    {
		$season = Season::withTrashed()->find($request->season_id);
		$this->authorize('restore', $season);
		
		$this->seasonService->restore($request->validated()['season_id']);
		return Response::json(['message' => "Season has been restored successfully."], 200);
    }
	
	/**
     * Handle an incoming permanently delete season request.
     *
     * @param  \App\Http\Requests\Account\DeleteSeasonRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function destroy(DeleteSeasonRequest $request)
    {
		$season = Season::withTrashed()->find($request->season_id);
		$this->authorize('destroy', $season);
		
		$this->seasonService->destroy($request->validated()['season_id']);
		return Response::json(['message' => "Season has been permanently deleted."], 200);
    }
	
}
