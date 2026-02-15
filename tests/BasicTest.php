<?php

use PHPUnit\Framework\TestCase;

/**
 * Basic sanity test to ensure the test infrastructure is working
 */
class BasicTest extends TestCase
{
    /**
     * Test that PHP is working correctly
     */
    public function testPhpVersion()
    {
        $this->assertGreaterThanOrEqual('7.4', PHP_VERSION, 'PHP version should be at least 7.4');
    }

    /**
     * Test that required extensions are loaded
     */
    public function testRequiredExtensions()
    {
        $this->assertTrue(extension_loaded('mysqli'), 'mysqli extension should be loaded');
        $this->assertTrue(extension_loaded('json'), 'json extension should be loaded');
    }

    /**
     * Test that basic math operations work (sanity check)
     */
    public function testBasicMath()
    {
        $this->assertEquals(4, 2 + 2);
        $this->assertEquals(10, 5 * 2);
    }

    /**
     * Test that file structure exists
     */
    public function testFileStructureExists()
    {
        $basePath = dirname(__DIR__);
        $this->assertFileExists($basePath . '/index.php', 'index.php should exist');
        $this->assertFileExists($basePath . '/config.php', 'config.php should exist');
        $this->assertDirectoryExists($basePath . '/database', 'database directory should exist');
        $this->assertDirectoryExists($basePath . '/validators', 'validators directory should exist');
    }
}
