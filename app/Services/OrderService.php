<?php
namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService{
    protected $orderRepo;
    /**
     * Class constructor.
     */
    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    function getAllOrder(){
        return $this->orderRepo->getAllOrder();
    }

    public function getOrderByTableAndStatus($table_name, $status) {
        if(!empty($table_name)&&!empty($status))
        {
            return $this->orderRepo->getOrderByTableAndStatus($table_name, $status);
        }
        return false;
    }

    public function getOrderByTable($table_name) {
        if(!empty($table_name))
        {
            return $this->orderRepo->getOrderByTable($table_name);
        }
        return false;
    }

    function createOrder($data){
        return $this->orderRepo->create($data);
    }

    function updateOrder($data, $id){
        return $this->orderRepo->update($data, $id);
    }

    function deleteOrder($id){
        return $this->orderRepo->delete($id);
    }

    function deleteOrderByTable($table_name){
        return $this->orderRepo->deleteOrderByTable($table_name);
    }
}
?>