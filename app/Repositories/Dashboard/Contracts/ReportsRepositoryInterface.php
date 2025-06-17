<?php

namespace App\Repositories\Dashboard\Contracts;

interface ReportsRepositoryInterface
{


        public function getAllReport();

        public function updateReport($id);

        public function storeReport($data);

                public function delete($id);

}
