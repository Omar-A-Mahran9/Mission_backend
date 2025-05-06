<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\Eloquent\UserRepository;

class UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
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
        return view('dashboard.users.show', compact('user'));

        // return $this->repository->show($document, $data);
    }
}
