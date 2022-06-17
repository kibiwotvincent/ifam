<?php

namespace App\Http\Services\Account\Admin;

use App\Models\Account\Admin\ChildSubCategory;
use App\Services\BaseService;

/**
 * Class ChildSubCategoryService.
 */
class ChildSubCategoryService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Service  $childSubCategory
     */
    public function __construct(ChildSubCategory $childSubCategory)
    {
        $this->model = $childSubCategory;
    }

    public function store(array $data = []): ChildSubCategory
    {
		$childSubCategory = ChildSubCategory::create([
			'name' => $data['name'],
			'description' => $data['description'],
			'parent_category_id' => $data['parent_category_id'],
		]);
		
        return  $childSubCategory;
    }

}
