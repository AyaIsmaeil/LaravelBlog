<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Policies\TagPolicy;
use App\Policies\PostPolicy;
use App\Policies\CommentPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Container\Attributes\Tag;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\Post::class => \App\Policies\PostPolicy::class,
        Comment::class => CommentPolicy::class,
    ];
    public function register(): void
    {


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
