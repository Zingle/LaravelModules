<?php

namespace Module;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use PHPUnit\Framework\TestCase;
use ZingleCom\LaravelModules\Exception\MissingModuleException;
use ZingleCom\LaravelModules\Module\ModuleInterface;
use ZingleCom\LaravelModules\Module\Repository;

/**
 * Class RepositoryTest
 */
class RepositoryTest extends TestCase
{
    /**
     * @throws MissingModuleException
     */
    public function testRegister()
    {
        $provider1 = $this->createMock(ServiceProvider::class);
        $module = $this->createMock(ModuleInterface::class);
        $module
            ->expects($this->exactly(3))
            ->method('getName')
            ->willReturn($name = 'FooModule')
        ;
        $module
            ->expects($this->once())
            ->method('getNamespace')
            ->willReturn($ns = 'FooNS')
        ;
        $module
            ->expects($this->once())
            ->method('getProviders')
            ->willReturn($providers = [$provider1])
        ;
        $app = $this->createMock(Application::class);
        $app
            ->expects($this->exactly(count($providers)))
            ->method('register')
            ->withConsecutive($providers)
        ;
        $repository = new Repository($app);
        $repository->register($module);

        $module = $repository->find($name);
        $this->assertInstanceOf(ModuleInterface::class, $module);
        $this->assertCount(1, $repository->all());
    }
}
