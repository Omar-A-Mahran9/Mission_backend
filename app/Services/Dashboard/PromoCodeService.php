<?php

namespace App\Services\Dashboard;

use Illuminate\Validation\Rule;
use App\Repositories\Dashboard\Contracts\PromoCodeRepositoryInterface;

class PromoCodeService
{
    protected $repository;

    public function __construct(PromoCodeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index($data)
    {

        if ($data->ajax()) {
            $query = $this->repository->index($data);

            $response = [
                "recordsTotal" => $query->count(),
                "recordsFiltered" => $query->count(),
                'data' => $query->get()
            ];
            return response($response);
        }
        return view('dashboard.promo-codes.index');
    }
}
