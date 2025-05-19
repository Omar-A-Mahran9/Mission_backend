<?php

namespace App\Repositories\Api\Contracts;

interface ExcperiencRepositoryInterface
{
    public function store($data);
    public function specialists($request, $id);
    public function show();
    public function skills($request);
    public function update($data, $id);
    public function destroy($id);
}
