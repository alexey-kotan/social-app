<?php

namespace App\Services;

use App\Models\User;

class SearchService
{
    public function userSearch($search)
    {
        if($search) {
            $users = User::where('id', $search)
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->get();
        }
        return compact('users');
    }
}