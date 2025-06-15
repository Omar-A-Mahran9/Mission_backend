<?php

namespace App\Repositories\Dashboard\Eloquent;

use App\Models\Offer;
use App\Repositories\Dashboard\Contracts\OffersRepositoryInterface;

class OffersRepository implements OffersRepositoryInterface
{


        protected $offer;   
    public function __construct(Offer $offer)
    {

        $this->offer = $offer;  
        // You can inject any dependencies here if needed
    }

    public function userOffers($user_id){
        return  $this->offer->with(['mission','status'])->where('user_id',$user_id)->get();
    }
}
