<?php

namespace App\Services\Api;

use App\Repositories\Api\Eloquent\MissionRepository;

class MissionService
{
    protected $missionRepository;

    public function __construct(MissionRepository $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    public function index()
    {
        return $this->missionRepository->index();
    }

    public function store(array $data)
    {
        return $this->missionRepository->store($data);
    }

    public function show($id)
    {
        return $this->missionRepository->show($id);
    }

    public function update($id, array $data)
    {
        return $this->missionRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->missionRepository->destroy($id);
    }
}
