<?php

namespace ZQuintana\LaravelModules\Module;

use Illuminate\Contracts\Foundation\Application;

/**
 * Interface ModuleInterface
 */
interface ModuleInterface
{
    /**
     * Additional providers to register
     *
     * @return array
     */
    public function getProviders(): array;

    /**
     * Name of the module
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Register callback
     *
     * @param Application $app
     * @return void
     */
    public function register(Application $app);

    /**
     * Path to the module
     *
     * @return string
     */
    public function getPath(): string;
}
