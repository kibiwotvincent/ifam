<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Admin\FarmCategory;
use App\Models\Account\Season;
use App\Models\Account\Sale;
use App\Http\Requests\Account\AddSaleRequest;
use App\Http\Services\Account\SaleService;
use App\Models\Account\Farm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

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
		$season = Season::find($request->season_id);
		$farm = Farm::find($request->farm_id);
		$sales = Sale::where('season_id', $request->season_id)->get();
        return view('account.season', ['farm' => $farm, 'season' => $season, 'sales' => $sales]);
    }

    /**
     * Handle an incoming add sale request.
     *
     * @param  \App\Http\Requests\Account\AddSaleRequest  $request
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(AddSaleRequest $request)
    {
		$this->saleService->store($request->validated());
		return Response::json(['message' => "Sale added successfully."], 200);
    }

    
}
