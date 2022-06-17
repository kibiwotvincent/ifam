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
	
	public function groupsStats(){
		$groups = Group::orderBy('name', 'asc')->get();
		
		$groupsStats = [];
		foreach($groups as $group){
			//get group's seasons
			$seasons = $group->seasons();
			
			$expenses = 0;
			$sales = 0;
			$profit = 0;
			$groupChildCategories = [];
			foreach($seasons as $season){
				$expenses += $season->total_expenses();
				$sales += $season->total_sales();
				$groupChildCategories[$season->child_category['name']] = $season->child_category['name'];
			}
			
			$profit = $sales - $expenses;
			$groupChildCategoriesString = implode(", ", $groupChildCategories);
			
			$groupStats = ['id' => $group['id'], 'name' => $group['name'], 'group_child_categories' => $groupChildCategoriesString, 'data' => ['expenses' => $expenses, 'sales' => $sales, 'profit' => $profit]];
			array_push($groupsStats, $groupStats);
		}
		return $groupsStats;
	}
	
	public function groupStats(Group $group){
		$groupStats = [];
		$farmers = [];
		//get group's seasons
		$groupSeasons = $group->seasons(false);
			
		$farmerType = "group";
		$farmerID = $group['id'];
		array_push($farmers, ['farmer_type' => $farmerType, 'farmer_id' => $farmerID, 'farmer_name' => $group['name'], 'seasons' => $groupSeasons]);
		
		foreach($group->members as $groupMember) {
			$farmerType = "individual";
			$farmerID = $groupMember['id'];
			$mergedSeasons = $groupMember->merged_seasons;
			$sns = [];
			foreach($mergedSeasons as $row) {
				$seasons = array_push($sns, $row->season);
			}
			array_push($farmers, ['farmer_type' => $farmerType, 'farmer_id' => $farmerID, 'farmer_name' => $groupMember->user['name'], 'seasons' => $sns]);
		}
		
		//populate group stats from members who have merged seasons
		foreach($farmers as $farmer) {
			$expenses = 0;
			$sales = 0;
			$profit = 0;
			$groupChildCategories = [];
			$farmers = [];
			foreach($farmer['seasons'] as $season){
				$expenses += $season->total_expenses();
				$sales += $season->total_sales();
				$groupChildCategories[$season->child_category['name']] = $season->child_category['name'];
			}
			$profit = $sales - $expenses;
			$groupChildCategoriesString = empty($groupChildCategories) ? "--" : implode(", ", $groupChildCategories);
			
			$farmerStats = ['farmer_type' => $farmer['farmer_type'], 'farmer_id' => $farmer['farmer_id'], 'farmer_name' => $farmer['farmer_name'], 'farmer_child_categories' => $groupChildCategoriesString, 'data' => ['expenses' => $expenses, 'sales' => $sales, 'profit' => $profit]];
			array_push($groupStats, $farmerStats);
		}
		
		return $groupStats;
	}

}
