<?php

namespace ZingleCom\LaravelModules;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
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
        /** @var ConfigRepository $config */
        $config = $this->app->make('config');
        $repository = new Repository($this->app);
        foreach ($config->get('modules.modules') as $module) {
            $repository->register(new $module());
        }

        $this->app->instance('laravel_modules.repository', $repository);
        $this->app->alias('laravel_modules.repository', Repository::class);

        return $this;
    }
}
