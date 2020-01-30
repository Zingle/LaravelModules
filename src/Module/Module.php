<?php
// phpcs:disable Symfony.NamingConventions.ValidClassName.InvalidAbstractName

namespace ZingleCom\LaravelModules\Module;

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
     * @var string
     */
    private $namespace;


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
    final public function getPath(): string
    {
        if (null === $this->path) {
            $reflected = new \ReflectionObject($this);
            $this->path = dirname($reflected->getFileName());
        }

        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return string
     */
    final public function getExtraPath(string $path): string
    {
        return $this->getPath().'/'.$path;
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

    /**
     * {@inheritdoc}
     */
    final public function getNamespace(): string
    {
        if (null === $this->namespace) {
            $pos = strrpos(static::class, '\\');
            $this->namespace = false === $pos ? '' : substr(static::class, 0, $pos);
        }

        return $this->namespace;
    }
}
// phpcs:enable
