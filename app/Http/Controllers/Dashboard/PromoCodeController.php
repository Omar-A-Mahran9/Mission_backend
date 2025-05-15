<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\PromoCodeService;

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
