<?php

declare(strict_types=1);

use Ziming\LaravelVidaId\LaravelVidaIdServiceProvider;

it('registers the package service provider and configuration', function (): void {
    expect(app()->getProvider(LaravelVidaIdServiceProvider::class))->not->toBeNull()
        ->and(config('vida-id.identity_verification_api_base_url'))
        ->toBe('https://services-sandbox.vida.id/main/v3/services/')
        ->and(config('vida-id.e_meterai_api_base_url'))
        ->toBe('https://sandbox-stamp-gateway.np.vida.id/');
});
