<?php

namespace App\Providers;

use App\Deploy;
use App\Services\Deployer;
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
        //
    }
}
