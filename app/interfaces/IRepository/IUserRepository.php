<?php

namespace App\interfaces\IRepository;
use Illuminate\Http\Request;

interface IUserRepository
{
    public function registerUser(Request $request);

    public function verifyUser(int $userId);

    public function loginUser(Request $data);

    public function UserForgetPassword();

    public function resetUserPassword();

    public function getBooks();
}
