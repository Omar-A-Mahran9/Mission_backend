<?php

namespace App\Http\Controllers\Api;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePortfolioRequest;
use App\Http\Requests\Api\UpdatePortfolioRequest;
use App\Http\Resources\Api\PortfolioResource;
use App\Services\Api\PortfolioService;

class PortfolioController extends Controller
{
    protected $service;

    public function __construct(PortfolioService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success("", PortfolioResource::collection($this->service->index()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePortfolioRequest $request)
    {
        $portfolio = $this->service->store($request);
        if (!$portfolio) {
            return $this->failure(__('Error in creating portfolio'));
        }
        return $this->success("", new PortfolioResource($portfolio));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortfolioRequest $request,  $portfolio)
    {
        // Check if the portfolio belongs to the authenticated user
        $portfolio = $this->service->update($request, $portfolio);
        if (!$portfolio) {
            return $this->failure($portfolio);
            // return $this->failure(__('Error in updating portfolio'));
        }
        return $this->success("", new PortfolioResource($portfolio));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio = $this->service->destroy($portfolio->id);
        if (!$portfolio) {
            return $this->failure(__('Error in deleting portfolio'));
        }
        return $this->success("", PortfolioResource::collection($portfolio));
    }
}
