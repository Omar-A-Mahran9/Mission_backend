<?php

namespace App\Repositories\Api\Contracts;


interface MissionRepositoryInterface
{
    public function index();
    public function store($data);
    public function find($id);
    public function update($id, array $data);
    public function destroy($id);
}
