<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Requests\IdentityVerification;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class WebElectronicKycRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /*
     * @see https://docs.vida.id/vida-identity-platform/integration-methods/web/api
     */
    public function __construct(
        protected readonly string $mobile, // E164 format
        protected readonly string $email,
        protected readonly string $govId, // nik 16 digits
        protected readonly string $fullName,
        protected readonly string $dob, // date of birth in YYYY-MM-DD format
        protected readonly string $idCardPhoto, // Max 10 MB. JPG / JPEG // Base64 String

        // Unique identifier for VIDA Partner.
        // The identity verification status would be notified to the partner against this partnerTrxId
        // by invoking the partner’s webhook URL. Max 36 characters
        protected readonly string $partnerTrxId, // Max 10 MB. JPG / JPEG // Base64 String
    ) {}

    protected function defaultBody(): array
    {
        return [
            'mobile' => $this->mobile,
            'email' => $this->email,
            'govId' => $this->govId,
            'fullName' => $this->fullName,
            'dob' => $this->dob,
            'idCardPhoto' => $this->idCardPhoto,
            'partnerTrxId' => $this->partnerTrxId,
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/web/ekyc';
    }
}
