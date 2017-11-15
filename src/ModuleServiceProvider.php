<?php

namespace ZingleCom\LaravelModules;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;
use ZingleCom\LaravelModules\Module\Repository;

/**
 * Class ModuleServiceProvider
 */
class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Boot
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/modules.php' => config_path('modules.php'),
        ], 'config');
    }

    /**
     * Register services
     */
    public function register()
    {
        $configPath = __DIR__.'/../config/modules.php';
        $this->mergeConfigFrom($configPath, 'modules');

        $this->registerRepository();
    }

    /**
     * @return $this
     */
    private function registerRepository()
    {
        $this->app->singleton('laravel_modules.repository', function (Container $container) {
            $repository = new Repository($container->make('app'));
            foreach ($container->make('config')->get('modules.modules') as $module) {
                $repository->register(new $module());
            }

            return $repository;
        });
        $this->app->alias('laravel_modules.repository', Repository::class);

        return $this;
    }
}
