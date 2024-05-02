<?php

namespace App\Http\Controllers;;

use App\Services\UserService;
use Illuminate\Http\Request;
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
        $this->userService->createUser($request->all());
    }
}
