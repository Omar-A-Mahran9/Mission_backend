<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Api\PromoCodeService;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    protected $service;

    public function __construct(PromoCodeService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $this->authorize('view_promo_codes');
        return $this->service->index($request);
    }
}
