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
			//user is already a member
			abort(406, 'You are already a member of the group.');
		}
		
		$groupMember = GroupMember::create([
			'group_id' => $groupID,
			'user_id' => $user->id,
			'position' => GroupMember::DEFAULT_POSITION,
			'status' => GroupMember::STATUS[1], //set status to pending
		]);
		
        return  $groupMember;
    }
	
	public function store(array $data = []): GroupMember
    {
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
		
		$groupMember = GroupMember::create([
			'group_id' => $groupID,
			'user_id' => $userID,
			'position' => GroupMember::DEFAULT_POSITION,
			'status' => GroupMember::STATUS[2], //set status to accepted
		]);
		
        return  $groupMember;
    }
	
	public function leave(array $data = [])
    {
		$user = Auth::user();
		
		$groupID = $data['group_id'];
		$userID = $user->id;
		
		if(GroupMember::where(['group_id' => $groupID, 'user_id' => $userID])->count() == 0) {
			//user is not a member
			abort(406, 'You are not a member of the group.');
		}
		
		GroupMember::where([
			'group_id' => $groupID,
			'user_id' => $userID
		])->delete();
		
		//check if is secretary and do the necessary clean ups
		
        return null;
    }
	
	public function cancel(array $data = [])
    {
		$user = Auth::user();
		
		$groupID = $data['group_id'];
		$userID = $user->id;
		
		if(GroupMember::where(['group_id' => $groupID, 'user_id' => $userID])->count() == 0) {
			//user is not a member
			abort(406, 'You are not a member of the group.');
		}
		
		GroupMember::where([
			'group_id' => $groupID,
			'user_id' => $userID
		])->delete();
		
		//check if is secretary and do the necessary clean ups
		
        return null;
    }
	
	public function update(array $data = []): GroupMember
    {
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
		
		GroupMember::find($data['member_id'])->delete();
		
		//check if is secretary and do the necessary clean ups
		
        return null;
    }
	
	public function approve(array $data = []): GroupMember
    {
		
		$groupMember = GroupMember::find($data['member_id']);
		$groupMember->status = "accepted";
		$groupMember->save();
		
        return $groupMember;
    }

}
