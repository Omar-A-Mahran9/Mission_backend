<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AddressResource;
use App\Http\Requests\Api\StoreAddressRequest;
use App\Http\Requests\Api\UpdateAddressRequest;

class AddressController extends Controller
{
    public function addresses()
    {
        $user = auth()->user()->addresses;
        return $this->success("Created successfully", AddressResource::collection($user));
    }
    public function store(StoreAddressRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $address = Address::create($data);
        return $this->success("Created successfully", new AddressResource($address));
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $data = $request->validated();
        if (auth()->user()->id != $address->user_id) {
            return $this->failure("You do not have access to update this address.");
        }
        $address->update($data);
        return $this->success("Updated successfully", new AddressResource($address));
    }

    public function destroy(Address $address)
    {
        if (auth()->user()->id != $address->user_id) {
            return $this->failure("You do not have access to delete this address.");
        }
        $address->delete();
        return $this->success("Deleted successfully");
    }
}
