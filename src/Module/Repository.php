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
    private $modules;


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
     * @return Repository
     */
    public function register(ModuleInterface $module): Repository
    {
        $this->modules[$module->getName()] = $module;

        $module->register($this->app);
        foreach ($module->getProviders() as $provider) {
            $this->app->register($provider);
        }

        return $this;
    }

    /**
     * @param string $name
     * @return ModuleInterface
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
    public function all()
    {
        return $this->modules;
    }
}
