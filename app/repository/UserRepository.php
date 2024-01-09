<?php

namespace App\repository;

use App\interfaces\IRepository\IUserRepository;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository {

    public  function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function registerUser(Request $request){
       $user = $this->userModel::create([
           "full_name"=> $request->full_name,
           "phone_number"=> $request->phone_number,
           "password"=> Hash::make($request->password)
       ]);

       return $user->id;
    }

    public function verifyUser(int $userId){
        $user = $this->userModel::find($userId);
        $user->email_verified_at = Carbon::now();
        return $user->save();
    }

    public function loginUser(Request $data){
        $user = $this->userModel
            ->where("phone_number",$data->phone_number)
            ->first();

        if (!$user) {
            throw new \Exception("User not found", 1);
        }

        if($user->email_verified_at == null){
            throw new \Exception("User has not been verified", 1);
        }

        $comparePasswords = \password_verify($data->password, $user->password);

        if (!$comparePasswords) {
            throw new \Exception("Password does not match", 1);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        return [
            'type' => 'user',
            'token' => $token,
            'data' => $user,
        ];
    }

    public function UserForgetPassword(){}

    public function resetUserPassword(){}

    public function getBooks(){}
}
