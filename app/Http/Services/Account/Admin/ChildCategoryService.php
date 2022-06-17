<?php

namespace App\Http\Services\Account\Admin;

use App\Models\Account\Admin\ChildCategory;
use App\Services\BaseService;

/**
 * Class ChildCategoryService.
 */
class ChildCategoryService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Service  $childCategory
     */
    public function __construct(ChildCategory $childCategory)
    {
        $this->model = $childCategory;
    }

    public function store(array $data = []): ChildCategory
    {
		$childCategory = ChildCategory::create([
			'name' => $data['name'],
			'description' => $data['description'],
			'parent_category_id' => $data['parent_category_id'],
		]);
		
        return  $childCategory;
    }

}
