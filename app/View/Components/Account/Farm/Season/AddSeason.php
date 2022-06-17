<?php

namespace App\View\Components\Account\Farm\Season;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use App\Models\Account\Admin\FarmCategory;
use App\Models\Account\Admin\ChildSubCategory;
use App\Models\Account\FarmDepartment;
use App\Models\Account\Farm;

class AddSeason extends Component
{
	/**
     * page
     *
     * @var integer
     */
    public $department;
	
	/**
     * crops
     *
     * @var array
     */
    public $child_categories;
	
	/**
     * varieties
     *
     * @var array
     */
    public $child_sub_categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {	
        $this->department = FarmDepartment::find($request->department_id);
		$this->child_categories = $this->department->category->child_categories()->orderBy('name', 'asc')->get();
		
		//get all child sub categories belonging to all child categories of the department's category
		$childCategoryIDs = $this->child_categories->pluck(['id']);
		
		$this->child_sub_categories = ChildSubCategory::whereIn('parent_category_id', $childCategoryIDs)->orderBy('name', 'asc')->get();
    }
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.account.farm.season.add-season');
    }
}
