<?php

namespace Hzmwdz\Tinyquote;

use Hzmwdz\Tinyquote\Console\ImportQuote;
use Illuminate\Support\ServiceProvider;

class TinyquoteServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__) . '/config/tinyquote.php', 'tinyquote');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(dirname(__DIR__) . '/database/migrations');

        $this->loadTranslationsFrom(dirname(__DIR__) . '/resources/lang', 'tinyquote');

        if ($this->app->runningInConsole()) {
            $this->commands([ImportQuote::class]);

            $this->loadPublishers();
        }
    }

    /**
     * @return void
     */
    protected function loadPublishers()
    {
        $this->publishes([
            dirname(__DIR__) . '/config/tinyquote.php' => $this->app->configPath('tinyquote.php')
        ], 'tinyquote-config');

        $this->publishes([
            dirname(__DIR__) . '/database/migrations' => $this->app->databasePath('migrations')
        ], 'tinyquote-migrations');

        $this->publishes([
            dirname(__DIR__) . '/database/imports' => $this->app->databasePath('imports')
        ], 'tinyquote-imports');

        $this->publishes([
            dirname(__DIR__) . '/resources/lang' => $this->app->resourcePath('lang/vendor/tinyquote')
        ], 'tinyquote-translations');
    }
}
