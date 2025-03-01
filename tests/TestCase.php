<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Ziming\LaravelVidaId\LaravelVidaIdServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelVidaIdServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
    }
}
