<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Admin\FarmCategory;
use App\Http\Requests\Account\AddFarmRequest;
use App\Http\Services\Account\FarmService;
use App\Models\Account\Group;
use App\Models\Account\Farm;
use App\Models\Account\Season;
use App\Models\User;
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
		$farmCategories = FarmCategory::orderBy('name', 'asc')->get();
		if($request->routeIs('group.*')) {
			$view = 'account.group.add-farm';
			$data['group'] = Group::find($request->group_id);
		}
		else {
			$view = 'account.add-farm';
		}
		$data['farm_categories'] = $farmCategories;
		
        return view($view, $data);
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
		
        return view('account.farms', ['farms' => $farms]);
    }
	
	/**
     * Display farm view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		//redirect to farms at the moment
		if($request->routeIs('group.*')) {
			//return redirect()->route('view_group');
		}
		else {
			return redirect()->route('farms');
		}
		
		
		$farm = Farm::find($request->farm_id);
		$view = $request->routeIs('group.*') ? 'account.group.farm' : 'account.farm';
		
		$data['farm'] = $farm;
        return view($view, $data);
    }
	
	/**
     * Display farm department view.
     *
     * @return \Illuminate\View\View
     */
    public function view_department(Request $request)
    {
		$farm = Farm::find($request->farm_id);
		$department = $farm->departments->only([$request->department_id])->first();
		
		if($request->routeIs('group.*')) {
			$view = 'account.group.department';
		}
		else {
			$view = 'account.department';
		}
		
		$data['farm'] = $farm;
		$data['department'] = $department;
        return view($view, $data);
    }
	
	/**
     * Display farm report view.
     *
     * @return \Illuminate\View\View
     */
    public function report(Request $request)
    {
		$farm = Farm::find($request->farm_id);
		$departments = FarmCategory::orderBy('name', 'asc')->get();
		$childCategories = ChildCategory::orderBy('name', 'asc')->get();
		
        return view('account.farm_report', ['farm' => $farm, 'seasons' => $farm->seasons(), 'departments' => $departments, 'child_categories' => $childCategories]);
    }

    /**
     * Handle an incoming add farm request.
     *
     * @param  \App\Http\Requests\Account\AddFarmRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddFarmRequest $request)
    {
		$this->farmService->store($request->validated());
		return Response::json(['message' => "Farm added successfully."], 200);
    }

    
}
