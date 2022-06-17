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

}
