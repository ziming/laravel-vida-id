<?php

namespace Ziming\LaravelVidaId\Requests\SignInline;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/*
 * Incomplete
 */
class DigitalSignatureRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /*
     * @see https://docs.vida.id/vida-identity-platform/integration-methods/api/sign-inline/api-reference/digital-signature
     */
    public function __construct(
        protected readonly string $partnerTrxId,
        protected readonly array $user,

        protected readonly string $requestInfoUserAgent,
        protected readonly string $requestInfoSourceIp,
        protected readonly string $requestInfoConsentTimestamp,

        protected readonly string $deviceOs,
        protected readonly string $deviceModel,
        protected readonly string $deviceUniqueId,
        protected readonly string $deviceNetworkProvider,

        protected readonly array $signingInfo,
    ) {

    }

    protected function defaultBody(): array
    {
        return [
            'partnerTrxId' => $this->partnerTrxId,
            'user' => $this->user,
            'requestInfo' => [
                'userAgent' => $this->requestInfoUserAgent,
                'srclp' => $this->requestInfoSourceIp,
                'consentTimestamp' => $this->requestInfoConsentTimestamp,
            ],
            'device' => [
                'os' => $this->deviceOs,
                'model' => $this->deviceModel,
                'uniqueId' => $this->deviceUniqueId,
                'networkProvider' => $this->deviceNetworkProvider,
            ],
            'signingInfo' => $this->signingInfo,
        ];
    }

    protected function defaultQuery(): array
    {
        return [
            'raType' => 'int',
            'docType' => 'template',
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/';
    }
}
