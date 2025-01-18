<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $fillable = ['user_id', 'post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class); // Cвязь с моделью Post
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Cвязь с моделью User
    }
}