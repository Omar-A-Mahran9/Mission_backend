<?php

namespace App\Repositories\Api\Contracts;

interface ReportsRepositoryInterface
{
    // define methods

    public function getAllReport();
    public function storeReport($data);
}
