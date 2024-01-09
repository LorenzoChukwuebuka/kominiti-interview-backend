<?php

namespace App\interfaces\IRepository;

interface IOTPRepository{
    public  function  createOtp (object $data );

    public function retrieveOTP(string $otpToken);

    public  function deleteOTP(int $id);
}
