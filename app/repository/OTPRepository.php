<?php

namespace App\repository;

use App\interfaces\IRepository\IOTPRepository;
use App\Models\OTP;

class OTPRepository implements IOTPRepository
{
    public  function __construct(OTP $OTP)
    {
        $this->OTPModel = $OTP;
    }


    public  function  createOtp (object $data ){
        return $this->OTPModel::create([
            "user_id"=>$data->user_id,
            "otp_token" => $data->otp_token
        ]);
    }

    public function retrieveOTP(string $otpToken){
        return $this->OTPModel::where("otp_token",$otpToken)->first();
    }

    public  function deleteOTP(int $id){
        return $this->OTPModel::find($id)->delete();
    }
}
