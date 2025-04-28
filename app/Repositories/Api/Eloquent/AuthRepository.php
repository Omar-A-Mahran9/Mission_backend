<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Api\Contracts\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{

    public function login($credentials)
    {
        dd($credentials);
    }

    // public function register($document = null, $dataUser)
    // {
    //     $user = User::create($dataUser);
    //     if ($document) {
    //         foreach ($document as $doc) {
    //             $document = $user->documents()->create([
    //                 'name' => $doc['name'],
    //                 'have_expiration_date' => $doc['have_expiration_date'],
    //                 'expiration_date' => $doc['expiration_date'],
    //                 'type_id' => $doc['type_id'],
    //             ]);
    //             foreach ($doc['files'] as $filePath) {
    //                 $document->files()->create(['file' => $filePath]);
    //             }
    //         }
    //     }
    //     dd($document, $dataUser, $user);

    //     return ;
    // }

    public function register($document = null, $dataUser)
    {
        DB::beginTransaction();

        try {
            $user = User::create($dataUser);
            if ($document) {
                foreach ($document as $doc) {
                    $docModel = $user->documents()->create([
                        'name' => $doc['name'],
                        'have_expiration_date' => $doc['have_expiration_date'],
                        'expiration_date' => $doc['expiration_date'],
                        'type_id' => $doc['type_id'],
                    ]);

                    foreach ($doc['files'] as $filePath) {
                        $docModel->files()->create(['file' => $filePath]);
                    }
                }
            }
            DB::commit();
            // Return the user, or whatever you need
            return true; // Success!
        } catch (\Throwable $e) {
            DB::rollBack();
            // Optionally log the error or rethrow
            throw $e;
        }
    }

    public function resendOtp($data)
    {
        $user = User::where('phone', 'LIKE', "%$data->phone%")->first();
        if (!$user) {
            return null;
        }
        $user->otp()->updateOrCreate(
            ['user_id' => $user->id],
            ['otp' => rand(1111, 9999)]
        );
        return $user;
    }
}
