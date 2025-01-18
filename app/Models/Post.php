<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_text',
        'post_image',
        'likes',
    ];

    public function userId() {
        return $this->belongsTo(User::class, 'user_id', 'id'); // Здесь 'user_id'-это внешний ключ
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id'); // Здесь 'user_id'-это внешний ключ
    }

    public function post_likes() {
        return $this->hasMany(PostLike::class); // Cвязь с моделью PostLike
    }
}
