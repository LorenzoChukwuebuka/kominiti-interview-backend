<?php

namespace App\Traits;

trait ApiResponse
{
    public function success( $message, $data, $status = 200)
    {
        return response(["code" => 1, "message" => $message, "payload" => $data ?? []], $status);
    }

    public function fail($message, $status = 400)
    {
        return response(["code" => 3, "error" => $message, "payload" => []], $status);
    }
}
