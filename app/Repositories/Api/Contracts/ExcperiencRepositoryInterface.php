<?php

namespace App\Repositories\Api\Contracts;

interface ExcperiencRepositoryInterface
{
    public function store($data);
    public function specialists($id);
    public function show();
    public function skills();
    public function update($data, $id);
    public function destroy($id);
}
