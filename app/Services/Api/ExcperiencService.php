<?php

namespace App\Services\Api;

use App\Repositories\Api\Eloquent\ExcperiencRepository;

class ExcperiencService
{
    protected $excperiencetRepository;

    public function __construct(ExcperiencRepository $excperiencetRepository)
    {
        $this->excperiencetRepository = $excperiencetRepository;
    }

    public function specialists($request,$id)
    {
        return $this->excperiencetRepository->specialists($request,$id);
    }
    public function store($data)
    {
        $validatedData = $data->validated();
        return $this->excperiencetRepository->store($validatedData);
    }
    public function show()
    {
        return $this->excperiencetRepository->show();
    }
    public function skills($request)
    {
        return $this->excperiencetRepository->skills($request);
    }
    public function update($data, $id)
    {
        $validatedData = $data->validated();
        return $this->excperiencetRepository->update($validatedData, $id);
    }
    public function destroy($id)
    {
        return $this->excperiencetRepository->destroy($id);
    }
}
