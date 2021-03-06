<?php

namespace ZingleCom\LaravelModules\Module;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * Interface ModuleInterface
 */
interface ModuleInterface
{
    /**
     * Additional providers to register
     *
     * @return array|ServiceProvider[]
     */
    public function getProviders(): array;

    /**
     * Register callback
     *
     * @param Application $app
     *
     * @return void
     */
    public function register(Application $app);

    /**
     * Path to the module
     *
     * @return string
     */
    public function getPath(): string;

    /**
     * @param string $path
     *
     * @return string
     */
    public function getExtraPath(string $path): string;

    /**
     * Name of the module
     *
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getNamespace(): string;
}
