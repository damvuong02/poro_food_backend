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
    public function getOrderByTableAndStatus($table_name, $status) {
        if(!empty($table_name)&&!empty($status))
        {
            return $this->orderRepo->getOrderByTableAndStatus($table_name, $status);
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
}
?>