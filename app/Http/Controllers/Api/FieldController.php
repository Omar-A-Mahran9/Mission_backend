<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UpdateUserFieldRequest;
use App\Http\Resources\Api\UserFieldResource;
use App\Models\Field;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\FieldResource;
use App\Services\Api\FieldService;

class FieldController extends Controller
{
    protected $service;

    public function __construct(FieldService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->success("", FieldResource::collection($this->service->index($request)));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Field $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Field $field)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserFieldRequest $request, Field $field)
    {
        return $this->success("", new UserFieldResource($this->service->update($request, $field)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Field $field)
    {
        //
    }

    public function fieldSkills()
    {
        return $this->success("", new UserFieldResource($this->service->fieldSkils()));
    }
}
