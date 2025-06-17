<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\Contracts\OffersRepositoryInterface;

class OffersService
{
    protected $offersRepository;

    public function __construct(OffersRepositoryInterface $offersRepository)
    {
        $this->offersRepository = $offersRepository;
    }

    public function userOffers($user_id){
      return  $this->offersRepository->userOffers($user_id);
    }
}
