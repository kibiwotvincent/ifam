<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account\Admin\FarmCategory;
use App\Http\Requests\Account\AddFarmRequest;
//use App\Http\Requests\Account\FarmReportRequest;
use App\Http\Services\Account\FarmService;
use App\Models\Account\Group;
use App\Models\Account\Farm;
use App\Models\Account\Season;
use App\Models\Account\FarmDepartment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Account\Admin\ChildCategory;
use Illuminate\Support\Facades\Validator;
use \Carbon\Carbon;

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
     * Display farm view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$farm = Farm::find($request->farm_id);
        return view('account.admin.farm', compact('farm'));
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
		
		
		$data['farm'] = $farm;
		$data['department'] = $department;
        return view('account.admin.department', $data);
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
		
		$view = $request->routeIs('group.*') ? 'account.group.farm_report' : 'account.admin.farm_report';
		
        return view($view, $data);
    }

}
