<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

use App\Services\JsonpFormat;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        /*$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);*/
        $this->app->singleton('JsonpFormat', function(){
            return new JsonpFormat;
        });
    }
}
