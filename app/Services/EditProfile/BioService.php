<?php

namespace App\Services\EditProfile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BioService
{
    public function bio(Request $request)
    {
        // находим авториз.пользователя
        $user = Auth::user();

        // проверка и сохранение био
        $user->bio = $request->input('bio_text');
        $user->save();
    }
}