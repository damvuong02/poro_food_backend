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

    public function create($data = []){
        $result = $this->model->create($data);
        if($result){
            return $result->load('account');
        }
        return false;
    }

    function update($data = [],$id){
        $result = $this->model->find($id);
        if($result){
            $result->update($data);
            return $result->load('account');
        }
        return false;
    }
}