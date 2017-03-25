<?php

namespace LaravelReactions\Tests\Integration;

use Orchestra\Testbench\TestCase;

class BaseTestCase extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->loadLaravelMigrations('testing');
        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__.'/../../src/Migrations'),
        ]);
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
