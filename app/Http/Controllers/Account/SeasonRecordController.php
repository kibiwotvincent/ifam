<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Account\AddSeasonRecordRequest;
use App\Http\Requests\Account\UpdateSeasonRecordRequest;
use App\Http\Requests\Account\DeleteSeasonRecordRequest;
use App\Http\Requests\Account\RestoreSeasonRecordRequest;
use App\Http\Requests\Account\DeleteSeasonRecordFileRequest;
use App\Http\Services\Account\SeasonRecordService;
use \App\Models\Account\Season;
use \App\Models\Account\SeasonRecord;
use \App\Models\Account\SeasonRecordFile;

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
     * Display season record view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$seasonRecord = SeasonRecord::withTrashed()->find($request->id);
		$this->authorize('view', $seasonRecord);
		
		$view = ($request->routeIs('group.*')) ? 'account.group.view_season_record' : 'account.view_season_record';
		$season = $seasonRecord->season;
		
        return view($view, compact('seasonRecord', 'season'));
    }
	
	/**
     * Display the update season record view.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
		$seasonRecord = SeasonRecord::findOrFail($request->id);
		$this->authorize('update', $seasonRecord);
		
		$view = ($request->routeIs('group.*')) ? 'account.group.update-season-record' : 'account.update-season-record';
		$season = $seasonRecord->season;
		
        return view($view, compact('seasonRecord', 'season'));
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
	
	/**
     * Handle an incoming update season record request.
     *
     * @param  \App\Http\Requests\Account\UpdateSeasonRecordRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateSeasonRecordRequest $request)
    {
		$seasonRecord = SeasonRecord::find($request->season_record_id);
		$this->authorize('update', $seasonRecord);
		
		$this->seasonRecordService->update($request->validated());
		return Response::json(['message' => "Season record updated successfully."], 200);
    }
	
	/**
     * Handle an incoming delete season record request.
     *
     * @param  \App\Http\Requests\Account\DeleteSeasonRecordRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function delete(DeleteSeasonRecordRequest $request)
    {
		$seasonRecord = SeasonRecord::find($request->season_record_id);
		$this->authorize('delete', $seasonRecord);
		
		$this->seasonRecordService->delete($request->validated()['season_record_id']);
		return Response::json(['message' => "Season record deleted successfully."], 200);
    }
	
	/**
     * Handle an incoming permanently delete season record request.
     *
     * @param  \App\Http\Requests\Account\DeleteSeasonRecordRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function destroy(DeleteSeasonRecordRequest $request)
    {
		$seasonRecord = SeasonRecord::withTrashed()->find($request->season_record_id);
		$this->authorize('destroy', $seasonRecord);
		
		$this->seasonRecordService->destroy($request->validated()['season_record_id']);
		return Response::json(['message' => "Season record has been permanently deleted."], 200);
    }
	
	/**
     * Handle an incoming restore deleted season record request.
     *
     * @param  \App\Http\Requests\Account\RestoreSeasonRecordRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function restore(RestoreSeasonRecordRequest $request)
    {
		$seasonRecord = SeasonRecord::withTrashed()->find($request->season_record_id);
		$this->authorize('restore', $seasonRecord);
		
		$this->seasonRecordService->restore($request->validated()['season_record_id']);
		return Response::json(['message' => "Season record has been restored successfully."], 200);
    }
	
	/**
     * Handle an incoming permanently delete season record file request.
     *
     * @param  \App\Http\Requests\Account\DeleteSeasonRecordFileRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function destroySeasonRecordFile(DeleteSeasonRecordFileRequest $request)
    {
		$seasonRecordFile = SeasonRecordFile::find($request->season_record_file_id);
		//user who can destroy season record can also destroy season record files
		$this->authorize('destroy', $seasonRecordFile->record);
		
		$this->seasonRecordService->destroySeasonRecordFile($request->validated()['season_record_file_id']);
		return Response::json(['message' => "Season record file has been permanently deleted."], 200);
    }
}
