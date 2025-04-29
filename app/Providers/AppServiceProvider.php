<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Api\Contracts\AuthRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\AuthRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\CityRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\CityRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\FieldRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\FieldRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\InterestRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\InterestRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\ForgetPasswordRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\ForgetPasswordRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\FaqRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\FaqRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function ($request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
