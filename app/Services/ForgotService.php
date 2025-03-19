<?php

namespace App\Services;

use Password;

class ForgotService
{
    public function forgot(array $data)
    {
        $status = Password::sendResetLink($data);

        if($status == Password::RESET_LINK_SENT) {
            return true;
        } else {
            return $status;
        }
    }
}