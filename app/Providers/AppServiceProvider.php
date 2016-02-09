<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Http\Request;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Carbon\Carbon::setLocale(\App::getLocale());

        Validator::extend('date_compare', function($attribute, $value, $parameters, $validator) {
            $from = new \DateTime($parameters[0]);
            $to = new \DateTime($value);
            return $from < $to;
        });

        Validator::extend('datetime_compare', function($attribute, $value, $parameters, $validator) {
            $from = new \DateTime($parameters[0]);
            $to = new \DateTime($value);
            return $from < $to;
        });

        Validator::extend('datetime_compare_now', function($attribute, $value, $parameters, $validator) {
            $clientDateTime = new \DateTime($value);
            $now = new \DateTime();
            $now->sub(new \DateInterval('PT1M'));
            return $clientDateTime >= $now;
        });

        // Validator::extend('protected_names', function($attribute, $value, $parameters, $validator) {
        //     return !in_array(mb_strtolower($value), $parameters);
        // });

        // // dd($request);
        // // dd(\Config::get('app.debug'));
        // // dd(config('app.debug'));

        // view()->composer('articles.index', function ($view) {
        //     $view->with('a', 'aaAaa');
            // $view->with('a', app('App\Article'));
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
