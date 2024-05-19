<?php

namespace Ziming\LaravelVidaId\Connectors;

use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Connector;
use Saloon\Traits\OAuth2\ClientCredentialsGrant;

class VidaEMeteraiConnector extends Connector
{
    use ClientCredentialsGrant;

    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId(config('vida-id.client_id'))
            ->setClientSecret(config('vida-id.client_secret'))
            ->setTokenEndpoint(config('vida-id.authentication_api_url'));
    }

    public function resolveBaseUrl(): string
    {
        return config('vida-id.e_Meterai_api_base_url');
    }
}
