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
        $certificates = $user->certificates()->with('files')->paginate(2); // paginate 6 items per page
        $total    = $user->certificates()->count();
        return response(['certificates' => $certificates, 'total' => $total]);
    }
    public function experiencesAjax(Request $request, User $user)
    {
        $experiences = $user->experiences()->with(['field', 'specialists', 'skills'])->paginate(2); // paginate 6 items per page
        $total    = $user->experiences()->count();
        return response(['experiences' => $experiences, 'total' => $total]);
    }
    public function approve(User $user, Document $document)
    {
        // $this->authorize('approve_users');
        return $this->service->approve($user, $document);
    }
}
