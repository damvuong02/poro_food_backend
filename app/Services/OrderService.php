<?php
namespace App\Services;

use App\Jobs\CreateNotificationJob;
use App\Jobs\DeleteUpdateOrderJob;
use App\Repositories\FoodRepository;
use App\Repositories\OrderRepository;
use App\Repositories\TableRepository;
use App\Repositories\WaiterNotificationRepository;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $orderRepo;
    protected $foodRepo;
    protected $tableRepo;
    protected $notificationRepo;

    /**
     * Class constructor.
     */
    public function __construct(OrderRepository $orderRepo, FoodRepository $foodRepo, TableRepository $tableRepo, WaiterNotificationRepository $notificationRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->foodRepo = $foodRepo;
        $this->tableRepo = $tableRepo;
        $this->notificationRepo = $notificationRepo;

    }

    function getAllOrder()
    {
        return $this->orderRepo->getAllOrder();
    }

    public function getOrderByTableAndStatus($table_name, $status)
    {
        if (!empty($table_name) && !empty($status)) {
            return $this->orderRepo->getOrderByTableAndStatus($table_name, $status);
        }
        return false;
    }

    public function getOrderByTable($table_name)
    {
        if (!empty($table_name)) {
            return $this->orderRepo->getOrderByTable($table_name);
        }
        return false;
    }

    public function getOrderByStatus($order_status)
    {
        if (!empty($order_status)) {
            return $this->orderRepo->getOrderByStatus($order_status);
        }
        return false;
    }

    public function createOrder($data)
    {
        $create_err = []; // Mảng lưu các lỗi phát sinh
        $successOrder = []; //Mảng lưu các Order được tạo thành công
        // Bắt đầu transaction
        DB::beginTransaction();

        try {
            foreach ($data as $index => $value) {
                $food = $this->foodRepo->findById($value['food_id']);
                
                // Kiểm tra số lượng hàng còn lại
                if ($value['quantity'] > $food->quantity) {
                    $create_err[] = [
                        'food_id' => $value['food_id'],
                        'food_name' => $food['food_name'],
                        'requested_quantity' => $value['quantity'],
                        'available_quantity' => $food->quantity,
                        'error' => 'Insufficient quantity'
                    ];
                } else {
                    // Tạo đơn hàng
                    $result = $this->orderRepo->create($value);

                    // Cập nhật thông tin hàng hóa
                    $result1 = $this->foodRepo->updateBeforeCreateOrder($value);

                    if (!$result || !$result1) {
                        throw new \Exception('Failed to create order or update food information.');
                    } else{
                        array_push($successOrder, $result);
                    }
                }
            }

            // Commit transaction nếu tất cả các xử lý đều thành công
            DB::commit();

            return [
                'success' => empty($create_err),
                'errors' => $create_err,
                'success_order' => $successOrder
            ];

        } catch (\Exception $e) {
            // Rollback transaction nếu có lỗi
            DB::rollBack();

            return [
                'error' => $e->getMessage()
            ];
        }
    }

    
    public function deleteNewOrder($data)
    {
        // Bắt đầu transaction
        DB::beginTransaction();
        
        try {
            foreach ($data as $index => $value) {   
                // Xóa order
                $result = $this->orderRepo->delete($value["id"]);

                // Cập nhật thông tin hàng hóa
                $result1 = $this->foodRepo->incrementQuantity($value);

                if (!$result || !$result1) {
                    throw new \Exception('Failed to create order or update food information.');
                } else{
                    
                }
            }
            $cookingOrder = $this->getOrderByTableAndStatus($value['table_name'], "Cooking");
            if(!$cookingOrder){
                $this->tableRepo->updateStatusByTableName($value['table_name'], "Empty");
            } 
            $allOrder = $this->orderRepo->getAllOrder();
            $allOrder =json_encode($allOrder);
            DeleteUpdateOrderJob::dispatch($allOrder);
            // Commit transaction nếu tất cả các xử lý đều thành công
            DB::commit();
            return [
                'message' =>"Success"
            ];

        } catch (\Exception $e) {
            // Rollback transaction nếu có lỗi
            DB::rollBack();

            return [
                'error' => $e->getMessage()
            ];
        }
    }

    function updateOrder($data, $id)
    {   
        $result = $this->orderRepo->update($data, $id);
        $allOrder = $this->orderRepo->getAllOrder();
        $allOrder =json_encode($allOrder);
        DeleteUpdateOrderJob::dispatch($allOrder);
        $notificationData = [
            "table_name" => $data["table_name"],
            "notification_status" => "Cooking",
        ];
        $createNotification = $this->notificationRepo->create($notificationData);
        if($createNotification){
             CreateNotificationJob::dispatch($createNotification);
        }
        return $result;
    }

    function deleteOrder($data)
    {   
        $result = $this->orderRepo->delete($data["id"]);
        if($result){
            $allOrder = $this->orderRepo->getAllOrder();
            $allOrder =json_encode($allOrder);
            DeleteUpdateOrderJob::dispatch($allOrder);
            $notificationData = [
                "table_name" => $data["table_name"],
                "notification_status" => "Done",
            ];
            $createNotification = $this->notificationRepo->create($notificationData);
            if($createNotification){
                 CreateNotificationJob::dispatch($createNotification);
            }
        }
        
        return $result;
    }

    function deleteOrderByTable($table_name)
    {
        return $this->orderRepo->deleteOrderByTable($table_name);
    }
}
