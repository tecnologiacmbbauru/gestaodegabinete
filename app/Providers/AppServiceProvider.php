<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
		
        //Força pegar a url do .env no campo APP_URL
        //Caso não fosse forçado ele vai ser redirecionado para o localhost. Exemplo de local host: 192.198.0.1:4000
        URL::forceRootUrl(Config::get('app.url'));
		
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
