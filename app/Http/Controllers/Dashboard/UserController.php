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
        return view('dashboard.users.show', $this->service->show($user));
    }
    public function certificatesAjax(Request $request, User $user)
    {
        return response($this->service->certificatesAjax($user));
    }
    public function experiencesAjax(Request $request, User $user)
    {

        return response($this->service->experiencesAjax($user));
    }
    public function licensesAjax(Request $request, User $user)
    {
        return response($this->service->licensesAjax($user));
    }
    public function portfoliosAjax(Request $request, User $user)
    {
        return response($this->service->portfoliosAjax($user));
    }
    public function approve(User $user, Document $document)
    {
        // $this->authorize('approve_users');
        if ($this->service->approve($user, $document)) {
            return redirect()->back();
        }
    }
}
