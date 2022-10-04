<?php

namespace App\Http\Services\Account;

use App\Models\Account\Farm;
use App\Models\Account\FarmDepartment;
use App\Models\Account\Group;
use App\Models\User;
use App\Services\BaseService;

/**
 * Class FarmService.
 */
class FarmService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Service  $farm
     */
    public function __construct(Farm $farm)
    {
        $this->model = $farm;
    }

    public function store(array $data = []): Farm
    {
		$farmableType = $data['owner'] == "group" ? Farm::GROUP_MODEL_NAME : Farm::USER_MODEL_NAME; 
		
		$farm = Farm::create([
			'farmable_type' => $farmableType,
			'farmable_id' => $data['owner_id'],
			'name' => $data['name'],
			'description' => $data['description'],
			'acreage' => $data['acreage'],
			'location' => $data['location'],
		]);
		
		//fill farm departments
		foreach($data['departments'] as $department) {
			FarmDepartment::firstOrCreate(['farm_id' => $farm['id'], 'department_id' => $department]);
		}
		
        return  $farm;
    }
	
	public function update(array $data = []): Farm
    {
		$farm = Farm::find($data['farm_id']);
		$existingFarmDepartments = $farm->departments->map(function($row) {
															return $row->department_id;
														});
		
		$farm->name = $data['name'];
		$farm->description = $data['description'];
		$farm->acreage = $data['acreage'];
		$farm->location = $data['location'];
		$farm->save();
		
		//update farm departments
		foreach($data['departments'] as $departmentID) {
			//check if department exists already
			$farmDepartment = FarmDepartment::withTrashed()->where(['farm_id' => $farm['id'], 'department_id' => $departmentID])->first();
			if($farmDepartment != null) {
				//department already exists
				if($farmDepartment->trashed()) { /*restore the department instead of creating a new one */
					$farmDepartment->restore();
				}
			}
			else {
				FarmDepartment::create(['farm_id' => $farm['id'], 'department_id' => $departmentID]);
			}
		}
		
		//remove farm departments if they were unchecked
		//get departments that were removed and delete them
		$newFarmDepartments = $data['departments'];
		
		$departmentsToBeRemoved = $existingFarmDepartments->diff($newFarmDepartments);
		foreach($departmentsToBeRemoved as $departmentID) {
			FarmDepartment::where(['farm_id' => $farm['id'], 'department_id' => $departmentID])->delete();
		}
		
        return  $farm;
    }
	
	/**
     * Delete farm.
     *
     * @param  int $farmID
     * @return bool
     */
    public function delete($farmID)
    {
		return Farm::find($farmID)->delete();
	}
	
	/**
     * Permanently delete farm.
     *
     * @param  int $farmID
     * @return bool
     */
    public function destroy($farmID)
    {
		$farm = Farm::withTrashed()->find($farmID);
		//fire an event `FarmDeleted` to delete farm departments
		return $farm->forceDelete();
	}
	
	/**
     * Restore deleted farm.
     *
     * @param  int $farmID
     * @return bool
     */
    public function restore($farmID)
    {
		return Farm::withTrashed()->find($farmID)->restore();
	}

}
