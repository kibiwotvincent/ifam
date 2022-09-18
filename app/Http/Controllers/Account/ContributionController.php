<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Group\AddContributionRequest;
use App\Http\Services\Account\Group\ContributionService;
use App\Models\Account\Contribution;
use App\Models\Account\Group;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
	
    protected $contributionService;

    /**
     * ContributionController constructor.
     *
     * @param  ContributionService  $contributionService
	 * @return void
     */
    public function __construct(ContributionService $contributionService)
    {
        $this->contributionService = $contributionService;
    }
	
	/**
     * Display group contributions view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
		$group = Group::find($request->id);
		$year = $request->year == null ? Date('Y') : $request->year;
		$month = $request->month == null ? Date('m') : $request->month;
		$years = Contribution::YEARS;
		$months = Contribution::MONTHS;
		$modes = Contribution::PAYMENT_MODES;
		
		$month = $year != Date('Y') ? 1 : $month;
		
        return view('account.group.contributions', compact('group','years', 'months', 'modes', 'year','month'));
    }
	
	/**
     * Display group contributions report view.
     *
     * @return \Illuminate\View\View
     */
    public function report(Request $request)
    {
		$group = Group::find($request->id);
		$year = $request->year == null ? Date('Y') : $request->year;
		$month = $request->month == null ? Date('m') : $request->month;
		$years = Contribution::YEARS;
		$months = Contribution::MONTHS;
		$modes = Contribution::PAYMENT_MODES;
		
		$month = $year != Date('Y') ? 1 : $month;
		$members = $group->members()->join('users', 'group_members.user_id', '=', 'users.id')->orderBy('users.first_name', 'asc')->select('group_members.*')->get();
		
        return view('account.group.contributions-report', compact('group', 'members', 'years', 'months', 'modes', 'year','month'));
    }
	
    /**
     * Handle an incoming add contribution request.
     *
     * @param  \App\Http\Requests\Account\Group\AddContributionRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddContributionRequest $request)
    {
		$this->contributionService->store($request->validated());
		return Response::json(['message' => "Group contribution saved successfully."], 200);
    }

}
