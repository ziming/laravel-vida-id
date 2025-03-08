<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Connectors;

use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Connector;
use Saloon\Traits\OAuth2\ClientCredentialsGrant;

/**
 * @see https://docs.vida.id/vida-identity-platform/integration-methods/api/income-verification/api-reference/income-verification
 */
class VidaIncomeVerificationConnector extends Connector
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
        return config('vida-id.income_verification_api_base_url');
    }
}
