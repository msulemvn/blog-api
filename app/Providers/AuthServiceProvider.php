<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        Auth::viaRequest('jwt', function ($request) {
            $token = $request->bearerToken();
            if ($token) {
                try {
                    $user = app('tymon.jwt')->setToken($token)->toUser();

                    return $user;
                } catch (\Exception $e) {
                    return null;
                }
            }

            return null;
        });
    }
}
