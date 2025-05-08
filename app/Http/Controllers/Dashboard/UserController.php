<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\UserService;

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
    public function approve(User $user, Document $document)
    {
        // $this->authorize('approve_users');
        return $this->service->approve($user, $document);
    }
}
