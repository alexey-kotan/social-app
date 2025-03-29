<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\PostLike;

class LikeService
{
    public function like_post($post_id)
    {
        $post = Post::findOrFail($post_id);

        // проверяем, ставил ли пользователь уже лайк на этот пост
        $like = PostLike::where('user_id', Auth::id())->where('post_id', $post_id)->first();

        if($like) { // если да
            $like->delete();  // удаляем его
            $post->decrement('likes'); // удаляем лайк из счетчика лайков в posts
        } else { // если нет
            PostLike::create([ // добавляем его
                'user_id' => Auth::id(),
                'post_id' => $post_id,
            ]);
            
            $post->increment('likes');  // добавлем лайк из счетчика лайков в posts
        }
    }

    public function likes_post($post_id)
    {
        $post = Post::findOrFail($post_id);

        $likes = PostLike::where('post_id', $post_id)->get();

        return $likes;
    }
}
