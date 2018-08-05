<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Auth::viaRequest('is-alliance', function() {
            if (\Auth::check()) {
                $user = \Auth::user();
                if ($user->sso->characterPublic->alliance_id === 99002367) {
                    return $user;
                }
            }
            return null;
        });
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
