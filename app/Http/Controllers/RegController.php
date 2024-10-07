<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reg;

class RegController extends Controller
{
    public function reg(Request $request) {
        $request->validate([
            'name'=>'required|string|min:2|max:20',
            'email'=>'required|email',
            'password'=>'required|string|min:6|max:40'
        ]);

        
    }
}
