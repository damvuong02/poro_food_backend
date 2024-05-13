<?php

namespace App\Repositories;

use App\Models\Bill;
use App\Repositories\BaseRepository;

class BillRepository extends BaseRepository
{

    function getModel()
    {
        return Bill::class;
    }
    public function getAll(){
        return $this->model->latest()->get()->load('account');
    }
}