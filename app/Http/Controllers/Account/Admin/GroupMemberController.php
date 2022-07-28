<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Account\Group\GroupMemberService;
use App\Models\Account\Group;
use App\Models\Account\GroupMember;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
	
    protected $groupMemberService;

    /**
     * GroupMemberController constructor.
     *
     * @param  GroupMemberService  $groupMemberService
	 * @return void
     */
    public function __construct(GroupMemberService $groupMemberService)
    {
        $this->groupMemberService = $groupMemberService;
    }
	
	/**
     * Display group member view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$group = Group::find($request->group_id);
		$member = $group->members->only([$request->member_id])->first();
		
        return view('account.admin.group_member', ['group' => $group, 'member' => $member]);
    }
	
	/**
     * Display group member report view.
     *
     * @return \Illuminate\View\View
     */
    public function report(Request $request)
    {
		$member = GroupMember::find($request->member_id);
		
		$seasons = $member->mergedSeasons(null, null);
		
		$departments = $member->departments();
		$categories = $member->categories();
		
        return view('account.admin.group_member_report', ['member' => $member, 'seasons' => $seasons, 'departments' => $departments, 'categories' => $categories, 'from' => null, 'to' => null]);
    }

}
