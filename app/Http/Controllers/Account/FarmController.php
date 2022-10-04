<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AddFarmRequest;
use App\Http\Requests\Account\UpdateFarmRequest;
use App\Http\Requests\Account\DeleteFarmRequest;
use App\Http\Requests\Account\RestoreFarmRequest;
use App\Http\Requests\Account\FarmReportRequest;
use App\Http\Services\Account\FarmService;
use App\Models\Account\Group;
use App\Models\Account\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Account\Admin\ChildCategory;

class FarmController extends Controller
{
	
    protected $farmService;

    /**
     * FarmController constructor.
     *
     * @param  FarmService  $farmService
	 * @return void
     */
    public function __construct(FarmService $farmService)
    {
        $this->farmService = $farmService;
    }
	
    /**
     * Display the add farm view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
		$data = [];
		if($request->routeIs('group.*')) {
			$group = Group::find($request->group_id);
			$this->authorize('create', [Farm::class, true, $group]);
			
			$view = 'account.group.add_farm';
			$data['group'] = $group;
		}
		else {
			$this->authorize('create', [Farm::class, false, null]);
			$view = 'account.add_farm';
		}
		
        return view($view, $data);
    }
	
	/**
     * Display the update farm view.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
		$farm = Farm::findOrFail($request->farm_id);
		$this->authorize('update', $farm);
		
		$view = ($request->routeIs('group.*')) ? 'account.group.update_farm' : 'account.update_farm';
		
        return view($view, compact('farm'));
    }

	
	/**
     * Display farms view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
		$user = Auth::user();
		$farms = $user->farms()->orderBy('name', 'asc')->get();
		
        return view('account.farms', compact('farms'));
    }
	
	/**
     * Display farm view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$farm = Farm::withTrashed()->find($request->farm_id);
		$this->authorize('view', $farm);
		
		$view = ($request->routeIs('group.*')) ? 'account.group.view_farm' : 'account.view_farm';
		
        return view($view, compact('farm'));
    }
	
	/**
     * Display farm departments page.
     *
     * @return \Illuminate\View\View
     */
    public function farm(Request $request)
    {
		$farm = Farm::withTrashed()->find($request->farm_id);
		$this->authorize('view', $farm);
		
		$view = ($request->routeIs('group.*')) ? 'account.group.farm' : 'account.farm';
		
        return view($view, compact('farm'));
    }
	
	/**
     * Display farm report view.
     *
     * @return \Illuminate\View\View
     */
    public function report(Request $request)
    {
		$farm = Farm::find($request->farm_id);
		
		$data = ['farm' => $farm, 'seasons' => $farm->seasons(), 'from' => null, 'to' => null];
		
		$view = $request->routeIs('group.*') ? 'account.group.farm_report' : 'account.farm_report';
		
        return view($view, $data);
    }

    /**
     * Handle an incoming add farm request.
     *
     * @param  \App\Http\Requests\Account\AddFarmRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddFarmRequest $request)
    {
		if($request->owner == 'group') {
			$group = Group::find($request->owner_id);
			$this->authorize('create', [Farm::class, true, $group]);
		}
		else {
			$this->authorize('create', [Farm::class, false]);
		}
		
		$this->farmService->store($request->validated());
		return Response::json(['message' => "Farm added successfully."], 200);
    }
	
	/**
     * Handle an incoming update farm request.
     *
     * @param  \App\Http\Requests\Account\UpdateFarmRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateFarmRequest $request)
    {
		$farm = Farm::find($request->farm_id);
		$this->authorize('update', $farm);
		
		$this->farmService->update($request->validated());
		return Response::json(['message' => "Farm updated successfully."], 200);
    }
	
	/**
     * Handle an incoming delete farm request.
     *
     * @param  \App\Http\Requests\Account\DeleteFarmRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function delete(DeleteFarmRequest $request)
    {
		$farm = Farm::find($request->farm_id);
		$this->authorize('delete', $farm);
		
		$this->farmService->delete($request->validated()['farm_id']);
		return Response::json(['message' => "Farm deleted successfully."], 200);
    }
	
	/**
     * Handle an incoming permanently delete farm request.
     *
     * @param  \App\Http\Requests\Account\DeleteFarmRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function destroy(DeleteFarmRequest $request)
    {
		$farm = Farm::withTrashed()->find($request->farm_id);
		$this->authorize('destroy', $farm);
		
		$this->farmService->destroy($request->validated()['farm_id']);
		return Response::json(['message' => "Farm has been permanently deleted."], 200);
    }
	
	/**
     * Handle an incoming restore deleted farm request.
     *
     * @param  \App\Http\Requests\Account\RestoreFarmRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function restore(RestoreFarmRequest $request)
    {
		$farm = Farm::withTrashed()->find($request->farm_id);
		$this->authorize('restore', $farm);
		
		$this->farmService->restore($request->validated()['farm_id']);
		return Response::json(['message' => "Farm has been restored successfully."], 200);
    }

    /**
     * Display farm report.
     *
	 * @param  \App\Http\Requests\Account\FarmReportRequest  $request
     * @return \Illuminate\View\View
     */
    public function farm_report(FarmReportRequest $request)
    {
		$farm = Farm::find($request->farm_id);
		$childCategories = ChildCategory::orderBy('name', 'asc')->get();

		//get farms and sales dated between from and to dates
		$viewData = ['farm' => $farm, 'seasons' => $farm->seasons($request->department, $request->categories), 
		'child_categories' => $childCategories, 'from' => $request->from, 'to' => $request->to];
		
		return response()
			->view('components.account.farm.farm_report_table', $viewData, 200)
			->header('Content-Type', "text/html; charset=UTF-8");
    }
	
}
