<?php

namespace App\Http\Controllers\Api;

use App\Models\Tip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TipResource;
use App\Services\Api\TipService;

class TipController extends Controller
{
    protected $service;

    public function __construct(TipService $service)
    {
         $this->service = $service;
    }


    public function index()
    {
        return $this->success("Tips fetched successfully", TipResource::collection($this->service->index()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tip $tip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tip $tip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tip $tip)
    {
        //
    }
}
