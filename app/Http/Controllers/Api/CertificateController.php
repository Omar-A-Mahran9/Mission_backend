<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreDocumentRequest;
use App\Http\Resources\Api\DocumentResource;
use App\Services\Api\CertificateService;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    protected $service;

    public function __construct(CertificateService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->success("", DocumentResource::collection($this->service->index()));
    }

    public function store(StoreDocumentRequest $request)
    {
        $created = $this->service->store($request);
        if (!$created) {
            return $this->failure(__('Error in creating certificate'));
        }
        return $this->success('', new DocumentResource($created));
    }
    public function update(Request $request, $id)
    {
        $updated = $this->service->update($request, $id);
        if (!$updated) {
            return $this->failure(__('Error in updating certificate'));
        }
        return $this->success('', $updated);
    }
    public function destroy($id)
    {
        $deleted = $this->service->destroy($id);
        if (!$deleted) {
            return $this->failure(__('Error in deleting certificate'));
        }
        return $this->success("", $deleted);
    }
}
