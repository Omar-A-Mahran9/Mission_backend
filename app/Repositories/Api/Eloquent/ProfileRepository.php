<?php

namespace App\Repositories\Api\Eloquent;


use App\Models\Interest;
use App\Models\SupportMessage;
use App\Models\User;
use App\Repositories\Api\Contracts\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{

    public function stepsStatus()
    {
        $user = auth()->user();
        if ($user) {
            $user->loadCount([
                'experiences',
                'certificates',
                'Licenses',
                'portfolios',
            ]);
            $data = [
                'over_view'     => !empty($user->short_description) && !empty($user->city_id),
                'experiences'  => $user->experiences_count > 0,
                'certificates' => $user->certificates_count > 0,
                'licenses'     => $user->licenses_count > 0,
                'portfolios'   => $user->portfolios_count > 0,
            ];
            return $data;
        }
    }

    public function overView()
    {
        $user = auth()->user();
        if ($user) {
            return $user;
        }
    }
    public function update($data)
    {
        $user = auth()->user();
        if ($user) {
            $user->update($data);
            return $user;
        }
    }
}
