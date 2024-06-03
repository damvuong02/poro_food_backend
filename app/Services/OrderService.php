<?php
namespace App\Services;

use App\Repositories\FoodRepository;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $orderRepo;
    protected $foodRepo;
    /**
     * Class constructor.
     */
    public function __construct(OrderRepository $orderRepo, FoodRepository $foodRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->foodRepo = $foodRepo;
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

    // Bắt đầu transaction
    DB::beginTransaction();

    try {
        foreach ($data as $index => $value) {
            $food = $this->foodRepo->findById($value['food_id']);
            
            // Kiểm tra số lượng hàng còn lại
            if ($value['quantity'] > $food->quantity) {
                $create_err[] = [
                    'food_id' => $value['food_id'],
                    'requested_quantity' => $value['quantity'],
                    'available_quantity' => $food->quantity,
                    'error' => 'Insufficient quantity'
                ];
            } else {
                // Tạo đơn hàng
                $result = $this->orderRepo->create($value);
                
                // Cập nhật thông tin hàng hóa
                $result1 = $this->foodRepo->updateBeforOrder($value);

                if (!$result || !$result1) {
                    throw new \Exception('Failed to create order or update food information.');
                }
            }
        }

        // Commit transaction nếu tất cả các xử lý đều thành công
        DB::commit();

        return [
            'success' => empty($create_err),
            'errors' => $create_err
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
        return $this->orderRepo->update($data, $id);
    }

    function deleteOrder($id)
    {
        return $this->orderRepo->delete($id);
    }

    function deleteOrderByTable($table_name)
    {
        return $this->orderRepo->deleteOrderByTable($table_name);
    }
}
