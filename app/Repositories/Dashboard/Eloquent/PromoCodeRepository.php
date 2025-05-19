<?php

namespace App\Repositories\Dashboard\Eloquent;

use App\Models\PromoCode;
use App\Repositories\Dashboard\Contracts\PromoCodeRepositoryInterface;

class PromoCodeRepository implements PromoCodeRepositoryInterface
{

    public function index($data)
    {
        $query = PromoCode::query();
        if ($data->search["value"]) {
            $query->where(function ($query) use ($data) {
                $query
                    ->where('name', 'LIKE', "%" . $data->search["value"] . "%")
                    ->orWhere('phone', 'LIKE', "%" . $data->search["value"] . "%")
                    ->orWhere('email', 'LIKE', "%" . $data->search["value"] . "%")->orWhere('created_at', 'LIKE', "%" . $data->search["value"] . "%");
            });
        }
        if ($data->columns[4]['search']['value']) {
            $query->where('status', $data->columns[4]['search']['value']);
        }
        return $query;
    }
}
