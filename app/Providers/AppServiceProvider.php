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
        $this->app->bind(
            \App\Repositories\Api\Contracts\SupportRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\SupportRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\ProfileRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\ProfileRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\ExcperiencRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\ExcperiencRepository::class
        );
        $this->app->bind(
            \App\Repositories\Dashboard\Contracts\UserRepositoryInterface::class,
            \App\Repositories\Dashboard\Eloquent\UserRepository::class
        );
        $this->app->bind(
            \App\Repositories\Dashboard\Contracts\PromoCodeRepositoryInterface::class,
            \App\Repositories\Dashboard\Eloquent\PromoCodeRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\BannerRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\BannerRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\HomeRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\HomeRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\OfferRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\OfferRepository::class
        );
        $this->app->bind(
            \App\Repositories\Api\Contracts\OfferLogsRepositoryInterface::class,
            \App\Repositories\Api\Eloquent\OfferLogsRepository::class
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
