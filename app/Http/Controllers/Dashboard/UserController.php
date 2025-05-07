<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Services\Dashboard\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    public function index(Request $request)
    {
        $this->authorize('view_users');
        return $this->service->index($request);
    }
    public function show(User $user)
    {
        $this->authorize('show_users');

        return $this->service->show($user);
    }
}
