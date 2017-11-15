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
    function module_path($name, $path = null)
    {
        $repository = app('laravel_modules.repository');

        return $path ? $repository->find($name)->getExtraPath($path) : $repository->find($name)->getPath();
    }
}
