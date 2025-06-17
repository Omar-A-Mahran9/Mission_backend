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
    public function approve($request, $user, $document)
    {
        // $request->validate([
        //     'reason' => 'required'
        // ]);
        // dd($request->all());
        return $this->repository->approve($request, $user, $document);
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
    public function status($user)
    {
        return $this->repository->status($user);
    }
    public function isValid($request, $user)
    {
        return $this->repository->isValid($request, $user);
    }
}
