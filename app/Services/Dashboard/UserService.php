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
        $certificates = $user->certificates()->with('files')->paginate(6, ['*'], 'certificates_page');
        $licenses     = $user->licenses()->with('files')->paginate(6, ['*'], 'licenses_page');
        $portfolios   = $user->portfolios()->with('files')->paginate(6, ['*'], 'portfolios_page');
        return compact('user', 'certificates', 'licenses', 'portfolios');
    }
    public function approve($user, $document)
    {
        $this->repository->approve($user, $document);
        return response(["Product update successfully"]);
    }
}
