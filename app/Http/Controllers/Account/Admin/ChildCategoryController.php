<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Admin\AddChildCategoryRequest;
use App\Http\Services\Account\Admin\ChildCategoryService;
use App\Models\Account\Admin\FarmCategory;
use App\Models\Account\Admin\ChildCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Auth;

class ChildCategoryController extends Controller
{
	
    protected $childCategoryService;

    /**
     * ChildCategoryController constructor.
     *
     * @param  ChildCategoryService $childCategoryService
	 * @return void
     */
    public function __construct(ChildCategoryService $childCategoryService)
    {
        $this->childCategoryService = $childCategoryService;
    }
	
    /**
     * Display the add child category view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
		$farmCategory = FarmCategory::find($request->id);
		$metadatas = ChildCategory::METADATAS;
        return view('account.admin.add-child-category', ['farm_category' => $farmCategory, 'metadatas' => $metadatas]);
    }
	
	/**
     * Display child category view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$farmCategory = FarmCategory::find($request->id);
		$childCategory = $farmCategory->child_categories->only([$request->child_category_id])->first();
		$childSubCategories = $childCategory->child_sub_categories()->orderBy('name', 'asc')->get();;
        return view('account.admin.child-category', ['farm_category' => $farmCategory, 'child_category' => $childCategory, 'child_sub_categories' => $childSubCategories]);
    }

    /**
     * Handle an incoming add child category request.
     *
     * @param  \App\Http\Requests\Account\AddChildCategoryRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddChildCategoryRequest $request)
    {
		$this->childCategoryService->store($request->validated());
		return Response::json(['message' => "Child category added successfully."], 200);
    }

    
}
