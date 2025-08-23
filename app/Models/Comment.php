<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'post_id', 'content'];
    function post()
    {
        return $this->belongsTo(Post::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
