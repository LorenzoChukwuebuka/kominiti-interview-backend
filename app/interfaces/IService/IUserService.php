<?php
namespace App\interfaces\IService;
use Illuminate\Http\Request;

interface IUserService
{
    public function registerUser(Request $request);

    public function verifyUser(Request $request);

    public function loginUser(Request $request);

    public function UserForgetPassword();

    public function resetUserPassword();

    public function getBooks(Request $request);
}
