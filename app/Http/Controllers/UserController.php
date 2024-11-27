<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($id) {
        try {
            $user = User::findOrFail($id);
            return view('user/userpage', ['user' => $user]);
        } 
        catch (\Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }
}