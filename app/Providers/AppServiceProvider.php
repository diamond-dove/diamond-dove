<?php

namespace App\Providers;

use App\Deploy;
use App\Services\Deployer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->singleton(Deployer::class, function () {
            return new Deployer(new Deploy(env('DEPLOY_API_KEY'), env('DEPLOYMENT_EMAIL')));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //
    }
}
