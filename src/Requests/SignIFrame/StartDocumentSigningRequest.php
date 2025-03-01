<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Requests\SignIFrame;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/*
 * Incomplete
 */
class StartDocumentSigningRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /*
     * @see https://docs.vida.id/vida-identity-platform/integration-methods/api/sign-inline/api-reference/digital-signature
     */
    public function __construct(
        protected readonly string $partnerTrxId,

        protected readonly string $requestInfoUserAgent,
        protected readonly string $requestInfoSourceIp,

        protected readonly string $deviceOs,
        protected readonly string $deviceModel,
        protected readonly string $deviceUniqueId,
        protected readonly string $deviceNetworkProvider,

        protected readonly array $signingInfo,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'partnerTrxId' => $this->partnerTrxId,
            'requestInfo' => [
                'userAgent' => $this->requestInfoUserAgent,
                'srclp' => $this->requestInfoSourceIp,
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

    public function resolveEndpoint(): string
    {
        return '/start';
    }
}
