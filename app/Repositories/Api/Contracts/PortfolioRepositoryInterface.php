<?php

namespace App\Repositories\Api\Contracts;

interface PortfolioRepositoryInterface
{
    public function index();
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
}
