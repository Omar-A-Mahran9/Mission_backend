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

    public function specialists($id)
    {
        return $this->excperiencetRepository->specialists($id);
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
    public function skills()
    {
        return $this->excperiencetRepository->skills();
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
