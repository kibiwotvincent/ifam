<?php

namespace App\Http\Services\Account\Group;

use App\Models\User;
use App\Models\Account\GroupMember;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

/**
 * Class GroupMemberService.
 */
class GroupMemberService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Service  $groupMember
     */
    public function __construct(GroupMember $groupMember)
    {
        $this->model = $groupMember;
    }

    public function join(array $data = []): GroupMember
    {
		$user = Auth::user();
		
		$groupID = $data['group_id'];
		$userID = $user->id;
		
		if(GroupMember::where(['group_id' => $groupID, 'user_id' => $userID])->count() > 0) {
			//user is already an approved member
			abort(406, 'You are already a member of the group.');
		}
					
		//update or create group member
        $groupMember = GroupMember::withNotAccepted()->updateOrCreate(
							['group_id' => $groupID, 'user_id' => $user->id],
							['position' => GroupMember::DEFAULT_POSITION, 'status' => GroupMember::STATUS[1]]
						);
		
        return  $groupMember;
    }
	
	public function store(array $data = []): GroupMember
    {
		//add member to group
		$user = User::where('id_number', $data['id_number'])->first();
		
		if(empty($user)) {
			//user not found
			abort(404, 'Member is not registered yet.');
		}
		$groupID = $data['group_id'];
		$userID = $user->id;
		
		if(GroupMember::where(['group_id' => $groupID, 'user_id' => $userID])->count() > 0) {
			//user is already a member
			abort(406, 'Member already in group.');
		}
		
		$groupMember = GroupMember::withNotAccepted()->updateOrCreate(
												['group_id' => $groupID, 'user_id' => $userID],
												['position' => GroupMember::DEFAULT_POSITION, 'status' => GroupMember::STATUS[2] /*set status to accepted*/]
											);
		
        return  $groupMember;
    }
	
	public function leave(array $data = [])
    {
		//when member leaves the group
		$user = Auth::user();
		
		$groupID = $data['group_id'];
		$userID = $user->id;
		
		if(GroupMember::where(['group_id' => $groupID, 'user_id' => $userID])->count() == 0) {
			//user is not a member
			abort(406, 'You are not a member of the group.');
		}
		
		return GroupMember::where([
									'group_id' => $groupID,
									'user_id' => $userID
								])->update(['status' => "removed"]);
		
		//check if is secretary and do the necessary clean ups
    }
	
	public function cancel(array $data = [])
    {
		//cancel join group request
		$user = Auth::user();
		
		$groupID = $data['group_id'];
		$userID = $user->id;
		
		if(GroupMember::withNotAccepted()->where(['group_id' => $groupID, 'user_id' => $userID])->count() == 0) {
			//user is not a member
			abort(406, 'You are not a member of the group.');
		}
		
		//since the entry existed just mark as removed
		return GroupMember::withNotAccepted()->where([
														'group_id' => $groupID,
														'user_id' => $userID
													])->update(['status' => "removed"]);
		
		//check if is secretary and do the necessary clean ups
    }
	
	public function update(array $data = []): GroupMember
    {
		//updates member position
		$groupID = $data['group_id'];
		$position = $data['position'];
		$groupMemberID = $data[$position];
		
		//reset group official being updated
		GroupMember::where([
			'group_id' => $groupID,
			'position' => $position,
		])->update(['position' => GroupMember::DEFAULT_POSITION]);
		
		$groupMember = GroupMember::find($groupMemberID);
		$groupMember->position = $position;
		$groupMember->save();
		
        return  $groupMember;
    }
	
	public function remove(array $data = [])
    {
		$groupMember = GroupMember::find($data['member_id']);
		$groupMember->status = "removed";
		return $groupMember->save();
		
		//check if is secretary and do the necessary clean up
    }
	
	public function approve(array $data = []): GroupMember
    {
		
		$groupMember = GroupMember::withNotAccepted()->find($data['member_id']);
		$groupMember->status = "accepted";
		$groupMember->save();
		
        return $groupMember;
    }

}
