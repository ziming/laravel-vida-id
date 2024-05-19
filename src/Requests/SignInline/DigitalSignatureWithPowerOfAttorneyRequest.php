<?php

namespace Ziming\LaravelVidaId\Requests\SignInline;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class DigitalSignatureWithPowerOfAttorneyRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /*
     * @see https://docs.vida.id/vida-identity-platform/integration-methods/api/sign-inline/api-reference/digital-signature-with-poa-power-of-attorney
     */
    public function __construct(
        protected readonly string $partnerTrxId,

        protected readonly string $signerEmail,
        protected readonly string $signerKeyId,
        protected readonly string $signerApiKey,
        protected readonly string $signerEncCCV,

        protected readonly string $requestInfoUserAgent,
        protected readonly string $requestInfoSourceIp,
        protected readonly string $requestInfoConsentTimestamp,

        protected readonly string $deviceOs,
        protected readonly string $deviceModel,
        protected readonly string $deviceUniqueId,
        protected readonly string $deviceNetworkProvider,

        protected readonly string $signingInfoPdfFile,
        protected readonly int $singingInfoPageNo, // maybe string?
        protected readonly string $signingInfoXPoint,
        protected readonly string $signingInfoYPoint,
        protected readonly string $signingInfoHeight, // maybe int?
        protected readonly string $signingInfoWidth, // maybe int?
        protected readonly bool $singingInfoQrEnable = false,
        protected readonly array $signingInfoAppearance = [],
    ) {

    }

    protected function defaultQuery(): array
    {
        return [
            'docType' => 'template',
        ];
    }

    protected function defaultBody(): array
    {
        return [
            'partnerTrxId' => $this->partnerTrxId,
            'signer' => [
                'email' => $this->signerEmail,
                'keyId' => $this->signerKeyId,
                'apiKey' => $this->signerApiKey,
                'encCCV' => $this->signerEncCCV,
            ],
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
            'signingInfo' => [
                'pdfFile' => $this->signingInfoPdfFile,
                'pageNo' => $this->singingInfoPageNo,
                'xPoint' => $this->signingInfoXPoint,
                'yPoint' => $this->signingInfoYPoint,
                'height' => $this->signingInfoHeight,
                'width' => $this->signingInfoWidth,
                'qrEnable' => $this->singingInfoQrEnable,
                'appearance' => $this->signingInfoAppearance,
            ],
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/poa';
    }
}
