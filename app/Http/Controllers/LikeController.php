<?php

namespace App\Http\Controllers;

use App\Services\LikeService;

class LikeController extends Controller
{

    private LikeService $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    // лайки/дизлайк на пост
    public function post_like($post_id) {

        $this->likeService->like_post($post_id);
        return redirect()->back();
    }

    // лайки на постах
    public function post_likes($post_id) {

        $likes = $this->likeService->likes_post($post_id);
        return view('user.likes', compact('likes'));
    }
}
