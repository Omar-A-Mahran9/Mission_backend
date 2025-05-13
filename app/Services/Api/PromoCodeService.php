<?php

namespace App\Services\Api;


use Illuminate\Validation\Rule;
use App\Repositories\Api\Eloquent\PromoCodeRepository;

class PromoCodeService
{
    protected $promoCodeRepository;

    public function __construct(PromoCodeRepository $promoCodeRepository)
    {
        $this->promoCodeRepository = $promoCodeRepository;
    }

    public function index($query)
    {
        $query->validate([
            'type' => ['required', Rule::in(['used', 'available'])],
        ]);
        return $this->promoCodeRepository->index($query);
    }
}
