<?php

namespace App\Http\Services\Account\Admin;

use App\Models\Account\Admin\FarmCategory;
use App\Services\BaseService;

/**
 * Class FarmCategoryService.
 */
class FarmCategoryService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Service  $farmCategory
     */
    public function __construct(FarmCategory $farmCategory)
    {
        $this->model = $farmCategory;
    }

    public function store(array $data = []): FarmCategory
    {
		$farmCategory = FarmCategory::create([
			'name' => $data['name'],
			'description' => $data['description'],
		]);
		
        return  $farmCategory;
    }

}
