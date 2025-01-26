<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function userSearch(Request $request) {

        $search = $request->input('search');
        $users = [];

        if($search) {
            $users = User::where('id', $search)
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->get();
        }
        
        return view('user/user_search', compact('users'));

    }
}
