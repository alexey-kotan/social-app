<?php

namespace App\Http\Controllers;

use App\Services\BanService;
use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    // отобразить всех пользователей
    public function all_users() {
        // данные пользователя
        $user = User::select('id', 'avatar', 'name', 'email', 'role', 'status', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get();
        
        return view('admin.all_users', compact('user')); // Передаем данные в представление
    }
    
    private BanService $banService;

    public function __construct(BanService $banService)
    {
        $this->banService = $banService;
    }
    // заблокировать пользователя (бан)
    public function ban_user(Request $request) {

        $this->banService->ban_user($request);

        return redirect()->back()->with('success', 'Пользователь заблокирован. Все посты пользователя были удалены');
    }

    // разблокировать пользователя
    public function unban_user(Request $request) {
        
        $this->banService->unban_user($request);
        
        return redirect()->back()->with('success', 'Пользователь разблокирован.');
    }
}

