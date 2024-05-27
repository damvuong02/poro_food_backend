<?php

namespace App\Repositories;

use App\Models\Bill;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

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
        $result->created_at = $data["created_at"];
        $result->save();
        if($result){
            return $result->load('account');
        }
        return false;
    }

    function update($data = [],$id){
        $result = $this->model->find($id);
        if($result){
            $result->update($data);
            $result->created_at = $data["created_at"];
            $result->save();
            return $result->load('account');
        }
        return false;
    }

    public function getBillsToday()
    {
        $today = Carbon::today();

        $billsToday = Bill::whereDate('created_at', $today)->get();
        
        return $billsToday;
    }
}