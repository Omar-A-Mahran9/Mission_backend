<?php

namespace App\Repositories\Api\Contracts;

interface OfferLogsRepositoryInterface
{
       public function taskHandOver($data);
    public function cancelOffer($data);
        public function userOfferLogs($offerId);

}
