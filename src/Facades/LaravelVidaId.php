<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ziming\LaravelVidaId\LaravelVidaId
 */
class LaravelVidaId extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ziming\LaravelVidaId\LaravelVidaId::class;
    }
}
