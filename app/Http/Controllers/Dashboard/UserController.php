<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\UserService;
use App\Http\Requests\Dashboard\UpdateApprovedRequest;

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
    public function approve(Request $request, User $user, Document $document)
    {
        // $this->authorize('approve_users');
        if ($this->service->approve($request, $user, $document)) {
            return redirect()->back();
        }
    }
    public function status(Request $request, User $user)
    {
        $this->authorize('upadate_status_users');
        return response($this->service->status($user));
    }
    public function isValid(Request $request, User $user)
    {
        $this->authorize('is_valid_users');
        $this->service->isValid($request, $user);
        return response(['successful']);
    }
}
