<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Season;
use App\Models\Account\Sale;
use App\Http\Requests\Account\AddSaleRequest;
use App\Http\Requests\Account\UpdateSaleRequest;
use App\Http\Requests\Account\DeleteSaleRequest;
use App\Http\Requests\Account\RestoreSaleRequest;
use App\Http\Services\Account\SaleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SaleController extends Controller
{
	
    protected $saleService;

    /**
     * SaleController constructor.
     *
     * @param  SaleService  $saleService
	 * @return void
     */
    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }
	
    /**
     * Display the add sale view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
		$season = Season::find($request->season_id);
		$this->authorize('create', [Sale::class, $season]);
		
		$view = ($request->routeIs('group.*')) ? 'account.group.add-sale' : 'account.add-sale';
		
        return view($view, ['season' => $season]);
    }
	
	/**
     * Display sale view.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
		$sale = Sale::withTrashed()->find($request->id);
		$this->authorize('view', $sale);
		
		$view = ($request->routeIs('group.*')) ? 'account.group.view_sale' : 'account.view_sale';
		$season = $sale->season;
		
        return view($view, compact('sale', 'season'));
    }
	
	/**
     * Display the update sale view.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
		$sale = Sale::findOrFail($request->id);
		$this->authorize('update', $sale);
		
		$view = ($request->routeIs('group.*')) ? 'account.group.update-sale' : 'account.update-sale';
		$season = $sale->season;
		
        return view($view, compact('sale', 'season'));
    }

    /**
     * Handle an incoming add sale request.
     *
     * @param  \App\Http\Requests\Account\AddSaleRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddSaleRequest $request)
    {
		$season = Season::find($request->season_id);
		$this->authorize('create', [Sale::class, $season]);
		
		$this->saleService->store($request->validated());
		return Response::json(['message' => "Sale added successfully."], 200);
    }

    /**
     * Handle an incoming update sale request.
     *
     * @param  \App\Http\Requests\Account\UpdateSaleRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(UpdateSaleRequest $request)
    {
		$sale = Sale::find($request->sale_id);
		$this->authorize('update', $sale);
		
		$this->saleService->update($request->validated());
		return Response::json(['message' => "Sale updated successfully."], 200);
    }
	
	/**
     * Handle an incoming delete sale request.
     *
     * @param  \App\Http\Requests\Account\DeleteSaleRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function delete(DeleteSaleRequest $request)
    {
		$sale = Sale::find($request->sale_id);
		$this->authorize('delete', $sale);
		
		$this->saleService->delete($request->validated()['sale_id']);
		return Response::json(['message' => "Sale deleted successfully."], 200);
    }
	
	/**
     * Handle an incoming permanently delete sale request.
     *
     * @param  \App\Http\Requests\Account\DeleteSaleRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function destroy(DeleteSaleRequest $request)
    {
		$sale = Sale::withTrashed()->find($request->sale_id);
		$this->authorize('destroy', $sale);
		
		$this->saleService->destroy($request->validated()['sale_id']);
		return Response::json(['message' => "Sale has been permanently deleted."], 200);
    }
	
	/**
     * Handle an incoming restore deleted sale request.
     *
     * @param  \App\Http\Requests\Account\RestoreSaleRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function restore(RestoreSaleRequest $request)
    {
		$sale = Sale::withTrashed()->find($request->sale_id);
		$this->authorize('restore', $sale);
		
		$this->saleService->restore($request->validated()['sale_id']);
		return Response::json(['message' => "Sale has been restored successfully."], 200);
    }
}
