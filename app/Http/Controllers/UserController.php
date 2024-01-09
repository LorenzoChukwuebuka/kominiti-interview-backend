<?php

namespace App\Http\Controllers;

use App\interfaces\IService\IUserService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use ApiResponse;
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function registerUser(Request $request)
    {
        try {
            $result = $this->userService->registerUser($request);
            return $this->success("created successfully",$result,201);
        } catch (\Throwable $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function verifyUser(Request $request)
    {
        try {
            $result = $this->userService->verifyUser($request);
            return $this->success("user verified successfully",$result,201);
        }catch (\Throwable $e){
            return $this->fail($e->getMessage());
        }
    }

    public function loginUser(Request $request)
    {
        try {
            $result = $this->userService->loginUser($request);
            return $this->success("logged in successful",$result,200);
        }catch (\Throwable $e){
            return $this->fail($e->getMessage());
        }
    }

    public function UserForgetPassword()
    {}

    public function resetUserPassword()
    {}

    public function getBooks()
    {}

}
