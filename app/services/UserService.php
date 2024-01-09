<?php

namespace App\services;

use App\Exceptions\CustomValidationException;
use App\interfaces\IRepository\IOTPRepository;
use App\interfaces\IRepository\IUserRepository;
use App\interfaces\IService\IUserService;
use Illuminate\Http\Request;
use Str;
use Twilio\Rest\Client;
use Validator;

class UserService implements IUserService
{
    public function __construct(IUserRepository $userRepository,IOTPRepository $otpRepository)
    {
        $this->userRepository = $userRepository;
        $this->otpRepository = $otpRepository;
    }

    public function registerUser(Request $request)
    {
        #validate request
        $validator = Validator::make( $request->all(), [
            "full_name" => "required",
            "phone_number" => "required|unique:users",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }
        #generate otp
        $token = Str::random(8);
        #save user to db
        $userId = $this->userRepository->registerUser($request);
        #save otp to the db
        $data = (object)[
            "user_id"=>$userId,
            "otp_token"=>$token
        ];
       $this->otpRepository->createOtp($data);
       #send otp message
        $this->sendMessage("Your OTP is $token. This is only for a one time use.",$request->phone_number);

        return $request->all();

    }

    public function verifyUser(Request $request)
    {
        #validate request
        $validator = Validator::make( $request->all(), [
            "token" => "required",
        ]);
        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        #find otp token
        $otp = $this->otpRepository->retrieveOTP($request->token);

        if($otp == null){
            throw new \Error("invalid otp");
        }
        #update user to verified
        $this->userRepository->verifyUser($otp->user_id);
        #delete otp
        $this->otpRepository->deleteOTP($otp->id);

        return "user verified";

    }

    public function loginUser(Request $request)
    {
        #validate request
        $validator = Validator::make( $request->all(), [
            "phone_number" => "required",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            throw new CustomValidationException($validator);
        }

        return $this->userRepository->loginUser($request);

    }

    public function UserForgetPassword()
    {}

    public function resetUserPassword()
    {}

    public function getBooks(Request $request)
    {

    }

    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }
}
