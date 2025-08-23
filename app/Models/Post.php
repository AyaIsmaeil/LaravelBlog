<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'category_id','user_id'];
    function user(){
        return $this->belongsTo(User::class);
    }
    function comments(){
        return $this->hasMany(Comment::class);
    }
    
    function category(){
        return $this->belongsTo(Category::class);
    }

    function tags(){
        return $this->belongsToMany(Tag::class);
    }

    
}
