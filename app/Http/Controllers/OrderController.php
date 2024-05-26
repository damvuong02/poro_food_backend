<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    //
    protected $orderService;
    /**
     * Class constructor.
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function getOrderByTableAndStatus(Request $request) {
        $table_name = $request->table_name;
        $order_status = $request->order_status;        
        $result = $this->orderService->getOrderByTableAndStatus($table_name,$order_status);
        if($result){
            return response()->json($result);
        }
        return response()->json(["message" => "Đơn đặt hàng không tồn tại"], 500);
    }

    public function getOrderByTable(Request $request) {
        $table_name = $request->table_name;
        $result = $this->orderService->getOrderByTable($table_name);
        if($result){
            return response()->json($result);
        }
        return response()->json(["message" => "Đơn đặt hàng không tồn tại"], 500);
    }

    function createOrder(Request $request) {
        $rules = [
            'food_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'table_name' => 'required',
            'order_status' => 'required',
        ];
        $messages = [
            'food_id.required' => 'Mã mặt hàng là bắt buộc',
            'price.required' => 'Giá bán là bắt buộc.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'table_name.required'   => 'Tên bàn là bắt buộc.',
            'order_status.required'   => 'Trạng thái là bắt buộc.',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
        $result = $this->orderService->createOrder($request->all());
        if($result){
            return response()->json(["message" => "Thêm đơn đặt món thành công",
            "data" => $result->load('food')], 200);
        }   else {
            return response()->json(["message" => "Thêm đơn đặt món thất bại"], 500);
        }
        
    }

    function updateOrder(Request $request, $id) {
        $rules = [
            'food_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'table_name' => 'required',
            'order_status' => 'required',
        ];
        $messages = [
            'food_id.required' => 'Mã mặt hàng là bắt buộc',
            'price.required' => 'Giá bán là bắt buộc.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'table_name.required'   => 'Tên bàn là bắt buộc.',
            'order_status.required'   => 'Trạng thái là bắt buộc.',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
        $newData = [
            "food_id" => $request->food_id,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "table_name" => $request->table_name,
            "order_status" => $request->order_status,
            'note' => $request->note
        ];
        $result = $this->orderService->updateOrder($newData, $id);
        if($result){
            return response()->json(["message" => "Cập nhật đơn đặt món thành công", 
            "data" => $result->load('food')], 200);
        }   else {
            return response()->json(["message" => "Cập nhật đơn đặt món thất bại"], 500);
        }
    }

    function deleteOrder($id) {
        $result = $this->orderService->deleteOrder($id);
        if($result){
            return response()->json(["message" => "Xóa đơn đặt món thành công"], 200);
        }   else {
            return response()->json(["message" => "Xóa đơn đặt món thất bại"], 500);
        }
        
    } 
    function deleteOrderByTableName(Request $request) {
        $table_name = $request->table_name;
        $result = $this->orderService->deleteOrderByTable($table_name);
        if($result){
            return response()->json(["message" => "Xóa đơn đặt món thành công"], 200);
        }   else {
            return response()->json(["message" => "Xóa đơn đặt món thất bại"], 500);
        }
        
    } 
}
