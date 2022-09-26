<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Admin\AddFarmCategoryRequest;
use App\Http\Services\Account\Admin\FarmCategoryService;
use App\Models\Account\Admin\FarmCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Auth;

class FarmCategoryController extends Controller
{
	
    protected $farmCategoryService;

    /**
     * FarmCategoryController constructor.
     *
     * @param  FarmCategoryService $farmCategoryService
	 * @return void
     */
    public function __construct(FarmCategoryService $farmCategoryService)
    {
        $this->farmCategoryService = $farmCategoryService;
    }
	
    /**
     * Display the add farm category view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
		$metadatas = FarmCategory::METADATAS;
        return view('account.admin.add-farm-category', compact('metadatas'));
    }
	
	/**
     * Display farm categories view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
		$farmCategories = FarmCategory::orderBy('name', 'asc')->get();
        return view('account.admin.farm-categories', ['farm_categories' => $farmCategories]);
    }
	
	/**
     * Display farm category view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$farmCategory = FarmCategory::find($request->id);
		$childCategories = $farmCategory->child_categories()->orderBy('name', 'asc')->get();;
        return view('account.admin.farm-category', ['farm_category' => $farmCategory, 'child_categories' => $childCategories]);
    }

    /**
     * Handle an incoming add farm category request.
     *
     * @param  \App\Http\Requests\Account\Admin\AddFarmCategoryRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddFarmCategoryRequest $request)
    {
		$this->farmCategoryService->store($request->validated());
		return Response::json(['message' => "Farm category added successfully."], 200);
    }

    
}
