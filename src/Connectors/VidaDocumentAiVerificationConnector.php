<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Connectors;

use Saloon\Http\Connector;
use Illuminate\Support\Facades\Cache;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\Traits\OAuth2\ClientCredentialsGrant;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Ziming\LaravelVidaId\Resources\DocumentAiResource;

class VidaDocumentAiVerificationConnector extends Connector implements Cacheable
{
    use ClientCredentialsGrant;
    use HasCaching;

    public function documentAiResource(): DocumentAiResource
    {
        return new DocumentAiResource($this);
    }

    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId(config('vida-id.client_id'))
            ->setClientSecret(config('vida-id.client_secret'))
            ->setTokenEndpoint(config('vida-id.authentication_api_url'))
            ->setDefaultScopes(['openid']);
    }

    public function resolveBaseUrl(): string
    {
        return config('vida-id.document_ai_api_base_url');
    }

    public function cacheExpiryInSeconds(): int
    {
        return 1800; // 30 minutes
    }

    public function resolveCacheDriver(): LaravelCacheDriver
    {
        return new LaravelCacheDriver(Cache::store(config('cache.default')));
    }
}
