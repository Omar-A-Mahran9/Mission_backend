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
        $user->load('field', 'city', 'certificates.files')->loadCount('offers', 'missions');

        return $user;
    }
    // public function login($credentials)
    // {
    //     $user = User::where('phone', 'LIKE', "%{$credentials['phone']}%")->first();
    //     if (!$user) {
    //         return null;
    //     }
    //     return $user;
    // }

    // public function register($document = null, $dataUser)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $user = User::create($dataUser);
    //         if ($document) {
    //             foreach ($document as $doc) {
    //                 $docModel = $user->documents()->create([
    //                     'name' => $doc['name'],
    //                     'have_expiration_date' => $doc['have_expiration_date'],
    //                     'expiration_date' => $doc['expiration_date'],
    //                     'type_id' => $doc['type_id'],
    //                 ]);

    //                 foreach ($doc['files'] as $filePath) {
    //                     $docModel->files()->create(['file' => $filePath]);
    //                 }
    //             }
    //         }
    //         DB::commit();
    //         // Return the user, or whatever you need
    //         return true; // Success!
    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         // Optionally log the error or rethrow
    //         throw $e;
    //     }
    // }

    // public function resendOtp($data)
    // {
    //     $user = User::where('phone', 'LIKE', "%$data->phone%")->first();
    //     if (!$user) {
    //         return null;
    //     }
    //     $user->otp()->updateOrCreate(
    //         ['user_id' => $user->id],
    //         ['otp' => rand(1111, 9999)]
    //     );
    //     return $user;
    // }
}
