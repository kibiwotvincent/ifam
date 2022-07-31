<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Account\Farm;
use App\Models\Account\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Account\Admin\UserService;
use App\Http\Requests\Account\Admin\UpdateUserRoleRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class FarmerController extends Controller
{
	
    protected $userService;

    /**
     * UserController constructor.
     *
     * @param  UserService  $userService
	 * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
	
	/**
     * Display the farmers view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
		$farmers = User::orderBy('first_name', 'asc')->get()->filter(function($user) {
						return $user->hasRole('Farmer');
					});
		
        return view('account.admin.farm.farmers', compact('farmers'));
    }
	
	/**
     * Display the farmer view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$farmer = User::find($request->user_id);
		$groups = $farmer->groups->filter(function($member) { 
						return $member->isAccepted();
					});
        return view('account.admin.farm.farmer', compact('farmer','groups'));
    }
	
	/**
     * Display the farm view.
     *
     * @return \Illuminate\View\View
     */
    public function farm(Request $request)
    {
		$farm = Farm::find($request->farm_id);
        return view('account.admin.farm.farm', compact('farm'));
    }
	
	/**
     * Display farm department view.
     *
     * @return \Illuminate\View\View
     */
    public function department(Request $request)
    {
		$farm = Farm::find($request->farm_id);
		$department = $farm->departments->only([$request->department_id])->first();
		
        return view('account.admin.farm.department', compact('farm','department'));
    }
	
	/**
     * Display season view.
     *
     * @return \Illuminate\View\View
     */
    public function season(Request $request)
    {
		$season = Season::find($request->season_id);
		$farm = $season->department->farm;
		
        return view('account.admin.farm.season', compact('season', 'farm'));
    }
	
	/**
     * Display farm report view.
     *
     * @return \Illuminate\View\View
     */
    public function farm_report(Request $request)
    {
		$farm = Farm::find($request->farm_id);
		$data = ['farm' => $farm, 'seasons' => $farm->seasons(), 'from' => null, 'to' => null];
		
        return view('account.admin.farm.farm_report', $data);
    }
	
	/**
     * Display farmer report view.
     *
     * @return \Illuminate\View\View
     */
    public function farmer_report(Request $request)
    {
		$user = User::find($request->user_id);
		$seasons = $user->seasons();
					
		$departments = $seasons->map(function($season){
							return $season->department->category;
						})->unique('id');
		
		$categories = $departments->map(function($category){
							return $category->child_categories->map(function($childCategory){
								return $childCategory;
							});
						})->flatten()->unique('id');
		
		$data = ['farmer' => $user, 'seasons' => $seasons, 'departments' => $departments, 'categories' => $categories, 'from' => null, 'to' => null];
		
        return view('account.admin.farm.farmer_report', $data);
    }
	
}
