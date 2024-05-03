<?php

namespace App\Http\Controllers;;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    //
    protected $userService;
    /**
     * Class constructor.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    function getAllUser()
    {
        return response()->json($this->userService->getAllUser(), 200);
    }

    

    function createUser(Request $request) {
        $rules = [
            'user_name' => 'required|max:200|unique:users,user_name',
            'name' => 'required|max:200',
            'password' => 'required',
            'roll' => 'required'
        ];
        $messages = [
            'user_name.required' => 'Tên người dùng là bắt buộc.',
            'user_name.max'      => 'Tên người dùng không được vượt quá 200 ký tự.',
            'user_name.unique'   => 'Tên người dùng đã được sử dụng.',
        
            'name.required' => 'Trường tên là bắt buộc.',
            'name.max'      => 'Trường tên không được vượt quá 200 ký tự.',
        
            'password.required' => 'Trường mật khẩu là bắt buộc.',
        
            'roll.required' => 'Trường quyền là bắt buộc.'
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $result = $this->userService->createUser($request->all());
        if($result){
            return response()->json(["message" => "Thêm tài khoản thành công"], 200);
        }   else {
            return response()->json(["message" => "Thêm tài khoản thất bại"], 500);
        }
        
    }

    function updateUser(Request $request, $id) {
        $rules = [
            'user_name' => 'required|max:200|unique:users,user_name',
            'name' => 'required|max:200',
            'password' => 'required',
            'roll' => 'required'
        ];
        $messages = [
            'user_name.required' => 'Tên người dùng là bắt buộc.',
            'user_name.max'      => 'Tên người dùng không được vượt quá 200 ký tự.',
            'user_name.unique'   => 'Tên người dùng đã được sử dụng.',
        
            'name.required' => 'Trường tên là bắt buộc.',
            'name.max'      => 'Trường tên không được vượt quá 200 ký tự.',
        
            'password.required' => 'Trường mật khẩu là bắt buộc.',
        
            'roll.required' => 'Trường quyền là bắt buộc.'
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $result = $this->userService->updateUser($request->all(), $id);
        if($result){
            return response()->json(["message" => "Cập nhật tài khoản thành công"], 200);
        }   else {
            return response()->json(["message" => "Cập nhật tài khoản thất bại"], 500);
        }
        
    }

    function deleteUser($id) {
        $result = $this->userService->deleteUser($id);
        if($result){
            return response()->json(["message" => "Xóa tài khoản thành công"], 200);
        }   else {
            return response()->json(["message" => "Xóa tài khoản thất bại"], 500);
        }
        
    } 
    
    function searchUser(Request $request) {
        $result = $this->userService->searchUserByUserName($request->input('user_name'));
        return response()->json($result, 200);
    }

}
