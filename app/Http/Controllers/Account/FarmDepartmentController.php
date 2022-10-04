<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\FarmDepartment;
use Illuminate\Http\Request;

class FarmDepartmentController extends Controller
{
	
	/**
     * Display farm department view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$department = FarmDepartment::find($request->department_id);
		$this->authorize('view', $department);
		
		$farm = $department->farm;
		
		$view = $request->routeIs('group.*') ? 'account.group.farm-department' : 'account.farm-department';
		
        return view($view, compact('farm', 'department'));
    }
	
}
