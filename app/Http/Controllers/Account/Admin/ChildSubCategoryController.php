<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Admin\AddChildSubCategoryRequest;
use App\Http\Services\Account\Admin\ChildSubCategoryService;
use App\Models\Account\Admin\FarmCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Auth;

class ChildSubCategoryController extends Controller
{
	
    protected $childSubCategoryService;

    /**
     * ChildSubCategoryController constructor.
     *
     * @param  ChildSubCategoryService $childSubCategoryService
	 * @return void
     */
    public function __construct(ChildSubCategoryService $childSubCategoryService)
    {
        $this->childSubCategoryService = $childSubCategoryService;
    }
	
    /**
     * Display the add child sub category view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
		$farmCategory = FarmCategory::find($request->id);
		$childCategory = $farmCategory->child_categories->only([$request->child_category_id])->first();
        return view('account.admin.add-child-sub-category', ['farm_category' => $farmCategory, 'child_category' => $childCategory]);
    }

    /**
     * Handle an incoming add child sub category request.
     *
     * @param  \App\Http\Requests\Account\AddChildSubCategoryRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddChildSubCategoryRequest $request)
    {
		$this->childSubCategoryService->store($request->validated());
		return Response::json(['message' => "Child sub category added successfully."], 200);
    }

    
}
