<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ExceptionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        app('Dingo\Api\Exception\Handler')->register(function (\Illuminate\Auth\Access\AuthorizationException $exception) {
                throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
