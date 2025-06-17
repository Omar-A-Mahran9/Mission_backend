<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\User;
use App\Models\ExcperienceUser;
use App\Models\Field;
use Illuminate\Support\Facades\DB;
use App\Repositories\Api\Contracts\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{

    public function login($credentials)
    {
        $user = User::where('phone', 'LIKE', "%{$credentials['phone']}%")->first();
        if (!$user) {
            return null;
        }
        return $user;
    }

    public function register($document = null, $dataUser)
    {
        DB::beginTransaction();
        try {
            $field = Field::find($dataUser['field_id']);
            if (!($field->is_critical)) {
                $dataUser['is_valid'] = 1;
            }
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
            if (!empty($dataUser['field_id'])) {
                $user->specialists()->sync($dataUser['specialist_ids']);
                $user->skills()->sync($dataUser['skill_ids']);
            }
            if (!empty($dataUser['interest_id'])) {
                $user->interests()->sync($dataUser['interest_id']);
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
