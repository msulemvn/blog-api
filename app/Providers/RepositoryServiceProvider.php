<?php

namespace App\Providers;

use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Eloquent\PostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );
    }
}
