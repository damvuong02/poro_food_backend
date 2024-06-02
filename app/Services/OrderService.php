<?php
namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService{
    protected $orderRepo;
    protected $foodSevice;
    /**
     * Class constructor.
     */
    public function __construct(OrderRepository $orderRepo, FoodService $foodSevice)
    {
        $this->orderRepo = $orderRepo;
        $this->foodSevice=$foodSevice;
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

    public function getOrderByStatus($order_status) {
        if(!empty($order_status))
        {
            return $this->orderRepo->getOrderByStatus($order_status);
        }
        return false;
    }

    function createOrder($data){
        
        $create_err =[];
        //Kiem tra so luong mon an co du khong
        foreach ($data as $index => $value) {
            $food = $this->foodSevice->findById(1);
            if($value['quantity'] > $food->quantity){
                $create_err[]=$value;
                // Xóa phần tử khỏi mảng $data
                unset($data[$index]);
            }
        }
       
        $data = array_values($data);
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