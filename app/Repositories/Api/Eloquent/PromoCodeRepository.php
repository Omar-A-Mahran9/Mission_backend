<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\PromoCode;
use App\Models\SupportMessage;
use App\Repositories\Api\Contracts\PromoCodeRepositoryInterface;

class PromoCodeRepository implements PromoCodeRepositoryInterface
{

    public function index($query)
    {
        $promoCodes = PromoCode::query()
            ->when($query->type == 'used', fn($q) => $q->usedByOthers())
            ->when($query->type == 'available', fn($q) => $q->available())
            ->paginate(20);

        return $promoCodes;
    }
}
