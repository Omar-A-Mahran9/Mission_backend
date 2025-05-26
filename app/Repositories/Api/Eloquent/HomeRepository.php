<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\User;
use App\Models\Field;
use App\Models\Mission;
use App\Models\Interest;
use App\Enums\UserStatus;
use App\Models\Specialist;
use App\Models\FieldSpecialist;
use App\Http\Resources\Api\InterestResource;
use App\Http\Resources\Api\MissionHomeResource;
use App\Http\Resources\Api\ProfessionalResource;
use App\Repositories\Api\Contracts\HomeRepositoryInterface;

class HomeRepository implements HomeRepositoryInterface
{
    public function index()
    {
        $fieldId = auth()->user()->field_id;
        $userSpecialistIds = auth()->user()->specialists()->get()->pluck('id')->toArray();
        $interestIds = auth()->user()->interests()->get()->pluck('id')->toArray();
        $fields = Field::withCount('missions')->when($fieldId, function ($query, $fieldId) {
            return $query->orderByRaw('id = ? DESC', [$fieldId]);
        })->orderBy('missions_count', 'desc')->limit(3)->get();
        $specialists = Field::with('specialists')->find($fieldId)->specialists
            ->sortByDesc(function ($item) use ($userSpecialistIds) {
                return in_array($item->id, $userSpecialistIds) ? 1 : 0;
            })
            ->values()->take(4);
        $missions = Field::find($fieldId)->missions()->with('user', 'field')->withCount('offers')->limit(3)->get();
        $professionals = User::with(['specialists', 'reviews'])
            ->where('id', '!=', auth()->id())
            ->where('id', '!=', auth()->id())
            ->where('status', UserStatus::Active->value)
            ->where('is_valid', 1)
            ->where(function ($query) use ($fieldId, $interestIds) {
                $query->where('field_id', $fieldId);

                if (!empty($interestIds)) {
                    $query->orWhereHas('interests', function ($q) use ($interestIds) {
                        $q->whereIn('interests.id', $interestIds);
                    });
                }
            })
            ->limit(3)
            ->get();
        return ["fields" => $fields, "field_name" => auth()->user()->field->name, "specialists" => $specialists, "missions" => $missions, "professionals" => $professionals];
    }

    // public function search($request)
    // {
    //     $type = $request->type;
    //     $search = $request->search;
    //     $user = auth()->user();
    //     $interests = $user->interests()->limit(4)->get();
    //     $interestIds = auth()->user()->interests()->get()->pluck('id')->toArray();
    //     $searchHistory = $user->searchHistory()->get();
    //     if ($type == 0 && is_null($search)) {
    //         $latestMissions = Mission::where('field_id', $user->field_id)->with('user', 'field')->withCount('offers')->limit(3)->get();
    //         return ["interests" => $interests, "search_history" => $searchHistory, "missions" => $latestMissions];
    //     } elseif ($type == 1 && is_null($search)) {
    //         $professionals = User::with(['specialists'])
    //             ->withAvg('reviews', 'rate')
    //             ->where('id', '!=', auth()->id())
    //             ->where('status', UserStatus::Active->value)
    //             ->where('is_valid', 1)
    //             ->where(function ($query) use ($user, $interestIds) {
    //                 $query->where('field_id', $user->field_id);

    //                 if (!empty($interestIds)) {
    //                     $query->orWhereHas('interests', function ($q) use ($interestIds) {
    //                         $q->whereIn('interests.id', $interestIds);
    //                     });
    //                 }
    //             })
    //             ->orderByDesc('reviews_avg_rate')
    //             ->limit(3)
    //             ->get();
    //         return ["interests" => $interests, "search_history" => $searchHistory, "professionals" => $professionals];
    //     } elseif ($type == 0 && !is_null($search)) {
    //         $missions = Mission::when($search, function ($query, $search) {
    //             $query->where('description_ar', 'like', '%' . $search . '%')->orWhere('description_en', 'like', '%' . $search . '%');
    //         })->with('user', 'field')->withCount('offers')->limit(3)->paginate(8);
    //         return  $missions;
    //     } elseif ($type == 1 && !is_null($search)) {
    //         $professionals = User::with(['specialists'])
    //             ->withAvg('reviews', 'rate')
    //             ->where('id', '!=', auth()->id())
    //             ->where('status', UserStatus::Active->value)
    //             ->where('is_valid', 1)
    //             ->where(function ($query) use ($user, $interestIds) {
    //                 $query->where('field_id', $user->field_id);
    //                 if (!empty($interestIds)) {
    //                     $query->orWhereHas('interests', function ($q) use ($interestIds) {
    //                         $q->whereIn('interests.id', $interestIds);
    //                     });
    //                 }
    //             })
    //             ->where(function ($query) use ($search) {
    //                 $query->where('first_name', 'like', '%' . $search . '%')
    //                     ->orWhere('last_name', 'like', '%' . $search . '%')
    //                     ->orWhere('email', 'like', '%' . $search . '%');
    //             })
    //             ->orderByDesc('reviews_avg_rate')
    //             ->limit(3)
    //             ->get();
    //         return ["interests" => $interests, "search_history" => $searchHistory, "professionals" => $professionals];
    //     }
    // }



    public function goTosearch($request)
    {
        $type = (int) $request->type;
        $user = auth()->user();

        $interestIds = $user->interests()->get()->pluck('id')->toArray();
        $interests = $user->interests()->limit(4)->get();
        $searchHistory = $user->searchHistory()->select('id', 'search_term')->get();

        $commonResponse = [
            "search_history" => $searchHistory,
            "interests" => InterestResource::collection($interests),
        ];

        if ($type === 0 && empty($search)) {
            $latestMissions = Mission::with(['user', 'field'])
                ->withCount('offers')
                ->where('field_id', $user->field_id)
                ->latest()
                ->limit(3)
                ->get();

            return array_merge($commonResponse, [
                "missions" => MissionHomeResource::collection($latestMissions)
            ]);
        }

        if ($type === 1 && empty($search)) {
            $professionals = $this->getFilteredProfessionals($user, $interestIds)
                ->orderByDesc('reviews_avg_rate')
                ->limit(3)
                ->get();
            return array_merge($commonResponse, [
                "professionals" => ProfessionalResource::collection($professionals)
            ]);
        }

        return response()->json([], 204); // no match
    }
    public function search($request)
    {
        $type = (int) $request->type;
        // $search = trim($request->search);
        $user = auth()->user();

        $interestIds = $user->interests()->get()->pluck('id')->toArray();
        $interests = $user->interests()->limit(4)->get();
        $searchHistory = $user->searchHistory()->get();

        // 📌 Default response
        $commonResponse = [
            "interests" => $interests,
            "search_history" => $searchHistory
        ];

        // 🧠 Missions tab with no search
        if ($type === 0 && empty($search)) {
            $latestMissions = Mission::select('discription_' . app()->getLocale())->with(['user', 'field'])
                ->withCount('offers')
                ->where('field_id', $user->field_id)
                ->latest()
                ->limit(3)
                ->get();

            return array_merge($commonResponse, [
                "missions" => $latestMissions
            ]);
        }

        // 🧠 Professionals tab with no search
        if ($type === 1 && empty($search)) {
            $professionals = $this->getFilteredProfessionals($user, $interestIds)
                ->orderByDesc('reviews_avg_rate')
                ->limit(3)
                ->get();

            return array_merge($commonResponse, [
                "professionals" => $professionals
            ]);
        }

        // // 🔍 Missions tab with search
        // if ($type === 0 && !empty($search)) {
        //     $missions = Mission::with(['user', 'field'])
        //         ->withCount('offers')
        //         ->where(function ($q) use ($search) {
        //             $q->where('description_ar', 'like', "%{$search}%")
        //                 ->orWhere('description_en', 'like', "%{$search}%");
        //         })
        //         ->latest()
        //         ->paginate(8);

        //     return MissionHomeResource::collection($missions)->response()->getData(true);
        // }

        // // 🔍 Professionals tab with search
        // if ($type === 1 && !empty($search)) {
        //     $professionals = $this->getFilteredProfessionals($user, $interestIds)
        //         ->where(function ($q) use ($search) {
        //             $q->where('first_name', 'like', "%{$search}%")
        //                 ->orWhere('last_name', 'like', "%{$search}%")
        //                 ->orWhere('email', 'like', "%{$search}%");
        //         })
        //         ->orderByDesc('reviews_avg_rate')
        //         ->limit(3)
        //         ->get();

        //     return array_merge($commonResponse, [
        //         "professionals" => $professionals
        //     ]);
        // }

        return response()->json([], 204); // no match
    }
    private function getFilteredProfessionals(User $user, array $interestIds)
    {
        return User::with(['specialists'])
            ->withAvg('reviews', 'rate')
            ->where('id', '!=', $user->id)
            ->where('status', UserStatus::Active->value)
            ->where('is_valid', 1)
            ->where(function ($query) use ($user, $interestIds) {
                $query->where('field_id', $user->field_id);

                if (!empty($interestIds)) {
                    $query->orWhereHas('interests', function ($q) use ($interestIds) {
                        $q->whereIn('interests.id', $interestIds);
                    });
                }
            });
    }
}
