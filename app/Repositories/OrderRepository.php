<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository
{

    function getModel()
    {
        return Order::class;
    }

    public function getAllOrder(){
        return $this->model->with('food.category')->get();
    }

    public function getOrderByTableAndStatus($table_name, $status){
        return $this->model->where('table_name', $table_name)->where('order_status', $status)->with('food.category')->get();
    }

    public function getOrderByTable($table_name){
        return $this->model->where('table_name', $table_name)->with('food.category')->get();
    }
    
    public function deleteOrderByTable($table_name) {
        return $this->model->where('table_name', $table_name)->delete();
    }

    public function create($data = []){
        $result = $this->model->create($data);
        if($result){
            $result->refresh();
            $result->load('food.category');
            return $result;
        }
        return false;
    }

}