<?php
namespace App\Repositories\Api\Eloquent;

use App\Models\Mission;
use App\Repositories\Api\Contracts\MissionRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class MissionRepository implements MissionRepositoryInterface
{
    public function index()
    {

        return Mission::with([
        'field',
        'specialist',
        'payment',
        'city',
        'user',
        'skills',
        'lastStatue.status',
        'offers'
    ])->get();
    }

    public function store($data)
    {
        return Mission::create($data);
    }

    public function attachFile(Mission $mission, $file)
    {
        // First, delete the old attachment (if any)
        if ($mission->attachments->isNotEmpty()) {
            deleteAttachmentFromDirectory($mission->attachments->first()); // Delete the old attachment
        }

        // Upload new attachment
        $path = uploadAttachmentToDirectory($file, 'mission/attachments');

        return $mission->attachments()->create([
            'file' => $path,
        ]);
    }


    public function find($id)
    {
        $mission =   Mission::with([
        'field',
        'specialist',
        'payment',
        'city',
        'user',
        'skills',
        'lastStatue.status',
        'offers',
        'attachments'
        ])->find($id);
        if (!$mission) {
            throw new ModelNotFoundException("Mission with ID {$id} not found.");
        }

        return $mission;
    }


        public function update($id, $data)
        {
            $mission = Mission::findOrFail($id);
            $mission->update($data);
            return $mission;
        }

        public function destroy($id)
        {
            $mission = Mission::findOrFail($id);
            return $mission->delete();
        }



public function getCurrentMission()
{
    return Mission::with('specialist', 'attachments')
        ->where('user_id', Auth::id())
        ->whereHas('lastStatue.status', function ($query) {
            $query->whereIn('name_en', ['Under review', 'Publishing']);
        })
        ->latest()
        ->get();
}

public function getDoneMission()
{
    return Mission::with('specialist', 'attachments')
        ->where('user_id', Auth::id())
        ->whereHas('lastStatue.status', function ($query) {
            $query->whereIn('name_en', ['Accepted', 'Received']);
        })
        ->latest()
        ->get();
}

}
