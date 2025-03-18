<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Requests\DocumentAi;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class DocumentAiVerificationRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected readonly string $partnerTrxId,
        protected readonly string $groupId,
        protected readonly string $idFrontSideImage,
        protected readonly string $userIp,
        protected readonly string $obtainedAt,
        protected readonly string $idType = 'ID_CARD',
        protected readonly string $country = 'IDN',
        protected readonly string $idSubtype = 'KTP',
        protected readonly bool $obtained = true,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'operations' => ['ocr', 'idVerification'],
            'payload' => [
                'partnerTrxId' => $this->partnerTrxId,
                'groupId' => $this->groupId,
                'idType' => $this->idType,
                'country' => $this->country,
                'idSubtype' => $this->idSubtype,
                'idFrontSideImage' => $this->idFrontSideImage,
            ],
            'userConsent' => [
                'userIp' => $this->userIp,
                'country' => $this->country,
                'obtained' => $this->obtained,
                'obtainedAt' => $this->obtainedAt,
            ],
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/verify';
    }
}
