<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Field;
use App\Models\Skill;
use App\Models\Interest;
use App\Models\Specialist;
use App\Models\SupportMessage;
use App\Models\FieldSpecialist;
use App\Models\SpecialistUser;
use App\Repositories\Api\Contracts\ExcperiencRepositoryInterface;

class ExcperiencRepository implements ExcperiencRepositoryInterface
{


    public function specialists($id)
    {
        return Field::find($id)->specialists()->get();
    }
    public function store($data)
    {
        auth()->user()->update(["field_id" => $data['field_id']]);
        auth()->user()->specialists()->sync($data['specialist_ids']);
        auth()->user()->skills()->sync($data['skill_ids']);
        return true;
    }
    public function skills()
    {
        return Skill::all();
    }

    public function update($data, $id)
    {
        $support = SupportMessage::find($id);
        if ($support) {
            $support->update($data);
            return $support;
        }
        return null;
    }
    public function show()
    {
        return auth()->user()->load('skills', 'specialists', 'field');
    }
    public function destroy($id)
    {
        $support = SupportMessage::find($id);
        if ($support) {
            $support->delete();
            return true;
        }
        return false;
    }
}
