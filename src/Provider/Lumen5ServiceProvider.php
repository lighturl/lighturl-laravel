<?php

namespace LightUrl\Laravel\Provider;

use Illuminate\Support\ServiceProvider;
use ReflectionClass;

class Lumen5ServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            $this->guessPackagePath() . '/migrations/' => base_path('/database/migrations')
        ]);    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('lighturl', function ($app) {
            return new \LightUrl\LightUrl($app['db']->connection());
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'lighturl'
        ];
    }

    /**
     * Guess real path of the package.
     *
     * @return string
     */
    public function guessPackagePath()
    {
        $path = (new ReflectionClass($this))->getFileName();
        return realpath(dirname($path).'/../');
    }
}
