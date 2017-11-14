<?php

namespace ZQuintana\LaravelModules\Module\Decorator;

use ZQuintana\LaravelModules\Module\ModuleInterface;

/**
 * Class PathDecorator
 */
class PathDecorator
{
    /**
     * @var ModuleInterface
     */
    private $module;


    /**
     * PathDecorator constructor.
     * @param ModuleInterface $module
     */
    public function __construct(ModuleInterface $module)
    {
        $this->module = $module;
    }

    /**
     * @param string $path
     * @return string
     */
    public function getPath($path = null): string
    {
        return $this->module->getPath().($path ?? '');
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->module, $name], $arguments);
    }
}
