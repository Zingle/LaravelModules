<?php

namespace ZingleCom\LaravelModules\Module;

use Illuminate\Contracts\Foundation\Application;
use ZingleCom\LaravelModules\Exception\MissingModuleException;

/**
 * Class Repository
 */
class Repository
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @var ModuleInterface[]
     */
    private $modules = [];


    /**
     * Repository constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->app = $application;
    }

    /**
     * @param ModuleInterface $module
     *
     * @return Repository
     */
    public function register(ModuleInterface $module): Repository
    {
        $this->modules[$module->getName()] = $module;

        $module->register($this->app);
        $providers = $module->getProviders();
        $inferredProvider = sprintf(
            '%s\Provider\%sServiceProvider',
            $module->getNamespace(),
            false !== ($pos = strrpos($module->getName(), 'Module')) ?
                substr($module->getName(), 0, $pos) : $module->getName()
        );
        if (class_exists($inferredProvider) && !in_array($inferredProvider, $providers)) {
            array_unshift($providers, $inferredProvider);
        }

        foreach ($providers as $provider) {
            $this->app->register($provider);
        }

        $helpersPath = $module->getExtraPath('helpers.php');
        if (file_exists($helpersPath)) {
            require_once $helpersPath;
        }

        return $this;
    }

    /**
     * @param string $name
     *
     * @return ModuleInterface
     *
     * @throws MissingModuleException
     */
    public function find($name): ModuleInterface
    {
        if (!isset($this->modules[$name])) {
            throw new MissingModuleException($name);
        }

        return $this->modules[$name];
    }

    /**
     * @return ModuleInterface[]
     */
    public function all(): array
    {
        return $this->modules;
    }
}
