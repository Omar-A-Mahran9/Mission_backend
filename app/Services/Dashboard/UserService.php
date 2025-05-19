<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\Contracts\UserRepositoryInterface;

class UserService
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
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
        return view('dashboard.users.index');
    }
    public function show($user)
    {
        $user = $this->repository->show($user);
        return compact('user');
    }
    public function approve($user, $document)
    {
        return $this->repository->approve($user, $document);
    }
    public function certificatesAjax($user)
    {
        return $this->repository->certificatesAjax($user);
    }
    public function experiencesAjax($user)
    {
        return $this->repository->experiencesAjax($user);
    }
    public function licensesAjax($user)
    {
        return $this->repository->licensesAjax($user);
    }
    public function portfoliosAjax($user)
    {
        return $this->repository->portfoliosAjax($user);
    }
}
