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

    // лайки на посты
    public function post_like($post_id) {

        $this->likeService->like_post($post_id);
        return redirect()->back();
    }
}
