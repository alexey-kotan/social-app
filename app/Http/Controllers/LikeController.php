<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // лайки на посты
    public function post_like($post_id) {

        $post = Post::findOrFail($post_id);

        // проверяем, ставил ли пользователь уже лайк на этот пост
        $like = PostLike::where('user_id', Auth::id())->where('post_id', $post_id)->first();

        if($like) { // если да
            $like->delete();  // удаляем его
            $post->decrement('likes'); // удаляем лайк из счетчика лайков в posts
            return redirect()->back();
        } else { // если нет
            PostLike::create([ // добавляем его
                'user_id' => Auth::id(),
                'post_id' => $post_id,
            ]);
            
            $post->increment('likes');  // добавлем лайк из счетчика лайков в posts
            return redirect()->back();
        }
    }
}
