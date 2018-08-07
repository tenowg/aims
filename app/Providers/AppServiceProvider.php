<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Gate;
use App\SubmittedItems;

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

        \Auth::viaRequest('is-package-owner', function($request){
            $package = SubmittedItems::find($request->route()->parameters['package']);
            $user = \Auth::user();

            if ($user->sso->character_id === $package->character_id) {
                return $user;
            }
            return null;
        });

        Gate::define('is-alliance', function($user) {
            return $user->sso->characterPublic->alliance_id == 99002367;
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
