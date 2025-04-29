<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\SupportMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreSupportRequest;
use App\Services\Api\SupportService;

class SupportMessageController extends Controller
{
    protected $service;

    public function __construct(SupportService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->service->index();
        if (!$result)
            return $this->failure(__("Failed to fetch support messages"));
        return $this->success(__("Support messages fetched successfully"), $result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupportRequest $request)
    {
        $result = $this->service->store($request);
        if (!$result)
            return $this->failure(__("Failed to send support message"));
        return $this->success(__("Support message sent successfully"));
    }

    /**
     * Display the specified resource.
     */
    public function show(SupportMessage $supportMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupportMessage $supportMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupportMessage $supportMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupportMessage $supportMessage)
    {
        //
    }
}
