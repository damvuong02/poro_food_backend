<?php

namespace App\Http\Controllers;;

use App\Jobs\DeleteNotificationJob;
use App\Services\WaiterNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WaiterNotificationController extends Controller
{
    //
    protected $waiterNotificationService;
    /**
     * Class constructor.
     */
    public function __construct(WaiterNotificationService $waiterNotificationService)
    {
        $this->waiterNotificationService = $waiterNotificationService;
    }

    function getAllWaiterNotification()
    {   
        return response()->json($this->waiterNotificationService->getAllWaiterNotification(), 200);
    }
    
    function createWaiterNotification(Request $request) {
        $result = $this->waiterNotificationService->createWaiterNotification($request->all());
        if($result){
            return response()->json(["message" => "Tạo thông báo thành công",
            "data" => $result], 200);
        }   else {
            return response()->json(["message" => "Tạo thông báo thất bại"], 500);
        }
    }

    function deleteWaiterNotification($id) {
        $result = $this->waiterNotificationService->deleteWaiterNotification($id);
        if($result){
            DeleteNotificationJob::dispatch($result);
            return response()->json(["message" => $result], 200);
        }   else {
            return response()->json(["message" => "Xóa thông báo thất bại"], 500);
        }
    } 
    
}
