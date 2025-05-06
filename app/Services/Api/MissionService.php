<?php

namespace App\Services\Api;

use App\Repositories\Api\Eloquent\MissionRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MissionService
{
    protected $missionRepository;

    public function __construct(MissionRepository $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    public function index()
    {
        return $this->missionRepository->index();
    }

    public function store($data)
    {
        return DB::transaction(function () use ($data) {
            $data['user_id'] = Auth::id();  // This stores only the user's ID


         if (isset($data['days_until_delivery'])) {
            $data['delivery_time'] = Carbon::now()->addDays($data['days_until_delivery']);
            unset($data['days_until_delivery']); // Clean up
        }


            $skills = $data['skills'] ?? [];
            unset($data['skills']);

            $mission = $this->missionRepository->store($data);

            if (!empty($skills)) {
                $mission->skills()->sync($skills);
            }

            if (request()->hasFile('attachments')) {
                foreach (request()->file('attachments') as $file) {
                    $this->missionRepository->attachFile($mission, $file);
                }
            }

            return $mission;
        });
    }



    public function show($id)
    {
        return $this->missionRepository->show($id);
    }

    public function update($id, array $data)
    {
        return $this->missionRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->missionRepository->destroy($id);
    }
}
