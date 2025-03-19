<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Connectors;

use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Connector;
use Saloon\Traits\OAuth2\ClientCredentialsGrant;
use Ziming\LaravelVidaId\Resources\DocumentAiResource;

class VidaDocumentAiVerificationConnector extends Connector
{
    use ClientCredentialsGrant;

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
}
