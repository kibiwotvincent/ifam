<?php

namespace App\Http\Services\Account\Group;

use App\Models\Account\Group;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

/**
 * Class GroupService.
 */
class GroupService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Service  $group
     */
    public function __construct(Group $group)
    {
        $this->model = $group;
    }

    public function store(array $data = []): Group
    {
		$user = Auth::user();
		
		$group = Group::create([
			'created_by' => $user->id,
			'name' => $data['name'],
			//'logo' => $data['logo'],
		]);
		
		//add group creator as secretary
		
        return  $group;
    }
	
	public function groupsStats($department = null, $categories = null, $from = null, $to = null){
		$groups = Group::orderBy('name', 'asc')->get();
		
		$groupsStats = [];
		foreach($groups as $group){
			//get group's seasons
			$seasons = $group->seasons(true, $department, $categories);
			
			$expenses = 0;
			$sales = 0;
			$profit = 0;
			$groupChildCategories = [];
			foreach($seasons as $season){
				$expenses += $season->total_expenses($from, $to);
				$sales += $season->total_sales($from, $to);
				$groupChildCategories[$season->child_category['name']] = $season->child_category['name'];
			}
			
			$profit = $sales - $expenses;
			$groupChildCategoriesString = implode(", ", $group->interests());
			
			$groupStats = ['id' => $group['id'], 'name' => $group['name'], 'group_child_categories' => $groupChildCategoriesString, 'data' => ['expenses' => $expenses, 'sales' => $sales, 'profit' => $profit]];
			array_push($groupsStats, $groupStats);
		}
		return $groupsStats;
	}
	
	public function groupStats(Group $group, $department = null, $categories = null, $from = null, $to = null){
		$groupStats = [];
		$farmers = [];
		
		//get group's seasons (seasons belonging to group farms)
		$groupSeasons = $group->seasons(false, $department, $categories);
		$farmerType = "group";
		$farmerID = $group['id'];
		array_push($farmers, ['farmer_type' => $farmerType, 'farmer_id' => $farmerID, 'farmer_name' => $group['name'], 'seasons' => $groupSeasons]);
		
		//get merged seasons (seasons merged into group by group members)
		foreach($group->members as $groupMember) {
			$farmerType = "individual";
			$farmerID = $groupMember['id'];
			$memberSeasons = [];
			
			$mergedSeasons = $groupMember->merged_seasons()->department($department)->childCategories($categories)->get();
			foreach($mergedSeasons as $row) {
				array_push($memberSeasons, $row->season);
			}
			
			array_push($farmers, ['farmer_type' => $farmerType, 'farmer_id' => $farmerID, 'farmer_name' => $groupMember->user['name'], 'seasons' => $memberSeasons]);
		}
		
		//populate group stats from farmers array
		foreach($farmers as $farmer) {
			$expenses = 0;
			$sales = 0;
			$profit = 0;
			$groupChildCategories = [];
			$farmers = [];
			foreach($farmer['seasons'] as $season){
				$expenses += $season->total_expenses($from, $to);
				$sales += $season->total_sales($from, $to);
				$groupChildCategories[$season->child_category['name']] = $season->child_category['name'];
			}
			
			if(empty($groupChildCategories)) { //this means the season has no data no need to proceed
				continue;
			}
			
			$profit = $sales - $expenses;
			$groupChildCategoriesString = implode(", ", $groupChildCategories);
			
			$farmerStats = ['farmer_type' => $farmer['farmer_type'], 'farmer_id' => $farmer['farmer_id'], 'farmer_name' => $farmer['farmer_name'], 'farmer_child_categories' => $groupChildCategoriesString, 'data' => ['expenses' => $expenses, 'sales' => $sales, 'profit' => $profit]];
			array_push($groupStats, $farmerStats);
		}
		
		return $groupStats;
	}

}
