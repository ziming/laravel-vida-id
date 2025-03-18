<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Connectors;

use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Connector;
use Saloon\Traits\OAuth2\ClientCredentialsGrant;
use Ziming\LaravelVidaId\Resources\IdentityVerificationResource;

class VidaIdentityVerificationConnector extends Connector
{
    use ClientCredentialsGrant;

    public function identityVerificationResource(): IdentityVerificationResource
    {
        return new IdentityVerificationResource($this);
    }

    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId(config('vida-id.client_id'))
            ->setClientSecret(config('vida-id.client_secret'))
            ->setTokenEndpoint(config('vida-id.authentication_api_url'))
            ->setDefaultScopes(['openid']); // Add the required scope

    }

    public function resolveBaseUrl(): string
    {
        return config('vida-id.identity_verification_api_base_url');
    }
}
