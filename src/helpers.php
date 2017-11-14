<?php

if (!function_exists('module_path')) {
    /**
     * Get the module path
     *
     * @param string $name
     * @param string $path
     *
     * @return string
     */
    function module_path($name, $path = null) {
        $repository = app('laravel_modules.repository');
        $module = new \ZQuintana\LaravelModules\Module\Decorator\PathDecorator(
            $repository->find($name)
        );

        return $module->getPath($path);
    }
}
