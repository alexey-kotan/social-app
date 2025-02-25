<?php

namespace App\Services;

use Illuminate\Http\Request;
use Password;

// class ForgotService
// {
//     public function forgot(array $data)
//     {
//         $status = Password::sendResetLink($data);
//         // Метод возвращает статус операции в виде строки, например 'Password::RESET_LINK_SENT', если ссылка была успешно отправлена.
        
//         if($status == Password::RESET_LINK_SENT){
//             return true;
//         } else {
//             return $status;
//         }
//     }
// }

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