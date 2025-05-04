<?php

namespace App\Repositories\Api\Contracts;

interface ProfileRepositoryInterface
{
    public function overView();
    public function update($data);
}
