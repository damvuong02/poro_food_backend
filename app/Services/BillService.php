<?php

namespace App\Services;

use App\Jobs\CreateNotificationJob;
use App\Jobs\DeleteUpdateOrderJob;
use App\Jobs\PayBillJob;
use App\Repositories\BillRepository;
use App\Repositories\FoodRepository;
use App\Repositories\OrderRepository;
use App\Repositories\TableRepository;
use App\Repositories\WaiterNotificationRepository;
use Illuminate\Support\Facades\DB;

class BillService{
    protected $billRepo;
    protected $orderRepo;
    protected $foodRepo;
    protected $notificationRepo;



    /**
     * Class constructor.
     */
    public function __construct(BillRepository $billRepository, FoodRepository $foodRepository, WaiterNotificationRepository $notificationRepository, OrderRepository $orderRepository)
    {
        $this->billRepo = $billRepository;
        $this->orderRepo = $orderRepository;
        $this->foodRepo = $foodRepository;
        $this->notificationRepo = $notificationRepository;

    }
    
    function getAllBill(){
        return $this->billRepo->getAll();
    }
    function createBill($data){
        return $this->billRepo->create($data);
    }
    function cashierCreateBill($data){
        DB::beginTransaction();
        
        try {
            $orders = $this->orderRepo->getOrderByTable($data["table_name"])->toArray();
            $newOrders = array_filter($orders, function ($order) {
                return $order['order_status'] === 'New';
            });
            $otherOrders = array_values(array_diff_key($orders, $newOrders));

            foreach ($newOrders as $index => $value) {   
                // Cập nhật thông tin hàng hóa
                $result = $this->foodRepo->incrementQuantity($value);

                if (!$result) {
                    throw new \Exception('Failed to create order or update food information.');
                } else{
                    
                }
            }
            $bill_data = [
            "table_name" => $data["table_name"], 
            "account_id" => $data["account_id"], 
            "created_at" => $data["created_at"],
            "bill_detail" => json_encode($otherOrders),
            ];
            // tạo bill
            $bill = $this->billRepo->create($bill_data);
            //xóa order liên quan
            $this->orderRepo->deleteOrderByTable($data["table_name"]);

            //bill được tạo bởi Thu Ngân thì tạo thông báo đến phục vụ.
            $notificationData = [
                "table_name" => $data["table_name"],
                "notification_status" => "Clean",
            ];
            $createNotification = $this->notificationRepo->create($notificationData);
            if($createNotification){
                 CreateNotificationJob::dispatch($createNotification);
            }

            //send event UpdateOrder
            $allOrder = $this->orderRepo->getAllOrder();
            $allOrder =json_encode($allOrder);
            DeleteUpdateOrderJob::dispatch($allOrder);
            PayBillJob::dispatch($bill->table_name);
            // Commit transaction nếu tất cả các xử lý đều thành công
            DB::commit();
        return $bill;

        } catch (\Exception $e) {
            // Rollback transaction nếu có lỗi
            DB::rollBack();

            return null;
        }
    }

    function updateBill($data, $id){
        return $this->billRepo->update($data, $id);
    }

    function deleteBill($id){
        return $this->billRepo->delete($id);
    }
    
    function findById($id){
        return $this->billRepo->findById($id);
    }

    function getBillsToday(){
        return $this->billRepo->getBillsToday();
    }

    function getRevenueByDayInWeek(){
        return $this->billRepo->getRevenueByDayInWeek();
    }

    function getRevenueByMonthInYear(){
        return $this->billRepo->getRevenueByMonthInYear();
    }

    function getRevenueByYear(){
        return $this->billRepo->getRevenueByYear();
    }
    
}
