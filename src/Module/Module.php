<?php

namespace ZQuintana\LaravelModules\Module;

use Illuminate\Contracts\Foundation\Application;

/**
 * Class Module
 */
abstract class Module implements ModuleInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $name;


    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getProviders(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): string
    {
        if (null === $this->path) {
            $reflected = new \ReflectionObject($this);
            $this->path = dirname($reflected->getFileName());
        }

        return $this->path;
    }

    /**
     * {@inheritdoc}
     */
    final public function getName(): string
    {
        if (null === $this->name) {
            $this->name = class_basename($this);
        }

        return $this->name;
    }
}
