<?php

namespace App\Services\Api;

use App\Http\Resources\Api\MissionResource;
use App\Models\Status;
use App\Repositories\Api\Eloquent\MissionRepository;
use App\Traits\RespondsWithHttpStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MissionService
{
    use RespondsWithHttpStatus;

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
            // unset($data['days_until_delivery']); // Clean up
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
                'skills',            // User relation
                'lastStatue.status',
            ]);
                    });
    }



  public function show($id)
    {
        return $this->missionRepository->find($id);
    }

    public function update($id, $data)
    {
        return DB::transaction(function () use ($id, $data) {
            // Fetch the mission to update
            $mission = $this->missionRepository->find($id);

            if (!$mission) {
                throw new \Exception("Mission not found.");
            }

            // Handle delivery time: Calculate and set 'delivery_time' based on 'days_until_delivery'
            if (isset($data['days_until_delivery'])) {
                $data['delivery_time'] = Carbon::now()->addDays($data['days_until_delivery']);
                // unset($data['days_until_delivery']);  // Remove 'days_until_delivery' field after processing
            }

            // Extract and remove skills from the data
            $skills = $data['skills'] ?? [];
            unset($data['skills']);  // Remove 'skills' from the mission data

            // Update the mission with the remaining data
            $this->missionRepository->update($id, $data);

            // Sync skills if provided
            if (!empty($skills)) {
                $mission->skills()->sync($skills);  // Sync the skills with the mission
            }

            // Handle file attachments if they exist
            if (request()->hasFile('attachments')) {
                foreach (request()->file('attachments') as $file) {
                    $this->missionRepository->attachFile($mission, $file);  // Attach the files to the mission
                }
            }

            // Return the updated mission with related data using eager loading
            return $mission->fresh()->load([
                'field',           // Field relation
                'specialist',      // Specialist relation
                'payment',         // Payment relation
                'city',            // City relation
                'user',
                'skills',            // User relation
                // User relation
                'lastStatue.status',  // Last status relation
            ]);
        });
    }



    public function destroy($id)
    {
        return $this->missionRepository->destroy($id);
    }

        public function getDoneMission()
    {
         $Mission = $this->missionRepository->getDoneMission();

        return $this->success('Done mission retrieved', MissionResource::collection($Mission));
    }

    public function getCurrentMission()
    {

         $Mission = $this->missionRepository->getCurrentMission();
        return $this->success('Current mission retrieved', MissionResource::collection($Mission));
    }


}
