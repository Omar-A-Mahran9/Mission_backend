<?php

namespace App\Services\Api;

use App\Models\Status;
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
            // Assign the first status (e.g. "قيد المراجعة" - "Under review")
            $firstStatus = Status::where('name_en', 'Under review')->first(); // Assuming you're using the English name here
            if ($firstStatus) {
                $mission->statue()->create([
                    'status_id' => $firstStatus->id,
                    'mission_id' => $mission->id,
                    'user_id' => Auth::id(), // Set user_id to the current authenticated user
                ]);
            }
            if (!empty($skills)) {
                $mission->skills()->sync($skills);
            }

            if (request()->hasFile('attachments')) {
                foreach (request()->file('attachments') as $file) {
                    $this->missionRepository->attachFile($mission, $file);
                }
            }
            return $mission->load([
                'field',
                'specialist',
                'payment',
                'city',
                'user',
                'lastStatue.status',
            ]);
                    });
    }



    public function show($id)
    {
        return $this->missionRepository->show($id);
    }

    public function update($id, $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $mission = $this->missionRepository->find($id);

            if (!$mission) {
                throw new \Exception("Mission not found.");
            }

            // Handle delivery time
            if (isset($data['days_until_delivery'])) {
                $data['delivery_time'] = Carbon::now()->addDays($data['days_until_delivery']);
                unset($data['days_until_delivery']);
            }

            // Extract and remove skills
            $skills = $data['skills'] ?? [];
            unset($data['skills']);

            // Update mission
            $this->missionRepository->update($id, $data);

            // Sync skills if provided
            if (!empty($skills)) {
                $mission->skills()->sync($skills);
            }

            // Handle new attachments
            if (request()->hasFile('attachments')) {
                foreach (request()->file('attachments') as $file) {
                    $this->missionRepository->attachFile($mission, $file);
                }
            }

            // Return updated with eager-loaded relations
            return $mission->fresh()->load([
                'field',
                'specialist',
                'payment',
                'city',
                'user',
                'lastStatue.status',
            ]);
        });
    }


    public function destroy($id)
    {
        return $this->missionRepository->destroy($id);
    }
}
