<?php

namespace App\Providers;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\EloquentRepositoryInterface;
use App\Repositories\Eloquent\Url\UrlRepository;
use App\Repositories\Eloquent\Url\UrlRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UrlRepositoryInterface::class, UrlRepository::class);
    }
}
