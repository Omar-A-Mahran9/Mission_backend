<?php
namespace App\Repositories\Api\Eloquent;

use App\Models\Mission;
use App\Repositories\Api\Contracts\MissionRepositoryInterface;

class MissionRepository implements MissionRepositoryInterface
{
    public function index()
    {

        return Mission::all();
    }

    public function store($data)
    {
        return Mission::create($data);
    }

    public function attachFile(Mission $mission, $file)
    {
        $path = uploadAttachmentToDirectory($file, 'mission/attachments');


        return $mission->attachments()->create([
            'file' => $path,
        ]);
    }


    public function show($id)
    {
        return Mission::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $mission = Mission::findOrFail($id);
        $mission->update($data);
        return $mission;
    }

    public function destroy($id) // 🔄 Rename to match interface
    {
        $mission = Mission::findOrFail($id);
        return $mission->delete();
    }
}
