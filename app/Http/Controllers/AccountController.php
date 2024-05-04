<?php

namespace App\Http\Controllers;;

use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\json;

class AccountController extends Controller
{
    //
    protected $accountService;
    /**
     * Class constructor.
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    function getAllAccount()
    {
        return response()->json($this->accountService->getAllAccount(), 200);
    }

    

    function createAccount(Request $request) {
        $rules = [
            'user_name' => 'required|max:200|unique:accounts,user_name',
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
        $result = $this->accountService->createAccount($request->all());
        if($result){
            return response()->json(["message" => "Thêm tài khoản thành công"], 200);
        }   else {
            return response()->json(["message" => "Thêm tài khoản thất bại"], 500);
        }
        
    }

    function updateAccount(Request $request, $id) {
        $rules = [
            'user_name' => 'required|max:200|unique:accounts,user_name',
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
        
        $newData = [
            "user_name" => $request->user_name,
            "name" => $request->name,
            "roll" => $request->roll,
            "password" => Hash::make($request->password),
        ];
        $result = $this->accountService->updateAccount($newData, $id);
        if($result){
            return response()->json(["message" => "Cập nhật tài khoản thành công"], 200);
        }   else {
            return response()->json(["message" => "Cập nhật tài khoản thất bại"], 500);
        }
        
    }

    function deleteAccount($id) {
        $result = $this->accountService->deleteAccount($id);
        if($result){
            return response()->json(["message" => "Xóa tài khoản thành công"], 200);
        }   else {
            return response()->json(["message" => "Xóa tài khoản thất bại"], 500);
        }
        
    } 
    
    function searchAccount(Request $request) {
        $result = $this->accountService->searchAccountByAccountName($request->input('user_name'));
        return response()->json($result, 200);
    }

}
