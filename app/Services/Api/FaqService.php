<?php

namespace App\Services\Api;

use App\Repositories\Api\Eloquent\FaqRepository;

class FaqService
{
    protected $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function index()
    {
        return $this->faqRepository->index();
    }

}
