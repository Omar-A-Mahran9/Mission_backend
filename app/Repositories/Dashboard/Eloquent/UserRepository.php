<?php

namespace App\Repositories\Dashboard\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\Dashboard\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function index($data)
    {
        $query = User::query();
        if ($data->search["value"]) {
            $query->where(function ($query) use ($data) {
                $query
                    ->where('name', 'LIKE', "%" . $data->search["value"] . "%")
                    ->orWhere('phone', 'LIKE', "%" . $data->search["value"] . "%")
                    ->orWhere('email', 'LIKE', "%" . $data->search["value"] . "%")->orWhere('created_at', 'LIKE', "%" . $data->search["value"] . "%");
            });
        }
        if ($data->columns[4]['search']['value']) {
            $query->where('status', $data->columns[4]['search']['value']);
        }
        return $query;
    }
    public function show($user)
    {
        $user->load('field', 'city')->loadCount('offers', 'missions');

        return $user;
    }
    public function approve($user, $document)
    {
        abort_if($document->user_id !== $user->id, 403);
        $document->update(['is_review' => true]);
        return $user;
    }
    public function certificatesAjax($user)
    {
        $certificates = $user->certificates()->with('files')->paginate(30); // paginate 6 items per page
        $total    = $user->certificates()->count();
        return ['certificates' => $certificates, 'total' => $total];
    }
    public function experiencesAjax($user)
    {
        $experiences = $user->experiences()->paginate(30); // paginate 6 items per page
        $total    = $user->experiences()->count();
        return ['experiences' => $experiences, 'total' => $total];
    }
    public function licensesAjax($user)
    {
        $licenses = $user->licenses()->with('files')->paginate(2); // paginate 6 items per page
        $total    = $user->licenses()->count();
        return ['licenses' => $licenses, 'total' => $total];
    }
    public function portfoliosAjax($user)
    {
        $portfolios = $user->portfolios()->with('files')->paginate(2); // paginate 6 items per page
        $total      = $user->portfolios()->count();
        return ['portfolios' => $portfolios, 'total' => $total];
    }
}
