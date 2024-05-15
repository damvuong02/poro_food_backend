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
    public function getOrderByTableAndStatus($table_name, $status){
        return $this->model->where('table_name', $table_name)->where('order_status', $status)->with('food.category')->get();
    }
 
}