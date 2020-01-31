<?php

namespace ZingleCom\LaravelModules\Tests\Module;

use PHPUnit\Framework\TestCase;

/**
 * Class ModuleTest
 */
class ModuleTest extends TestCase
{
    /**
     * Test module methods
     */
    public function testModule()
    {
        $module = new TestModule();
        $reflection = new \ReflectionObject($this);
        $this->assertEquals($dir = dirname($reflection->getFileName()), $module->getPath());
        $this->assertEquals(sprintf('%s/test', $dir), $module->getExtraPath('test'));
        $this->assertEquals('TestModule', $module->getName());
        $this->assertEquals('ZingleCom\LaravelModules\Tests\Module', $module->getNamespace());
    }
}
