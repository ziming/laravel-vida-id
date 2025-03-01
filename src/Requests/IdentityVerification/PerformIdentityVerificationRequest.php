<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Requests\IdentityVerification;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class PerformIdentityVerificationRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /*
     * @see https://docs.vida.id/vida-identity-platform/integration-methods/api/identity-verification/api-reference/perform-identity-verification
     */
    public function __construct(
        protected readonly string $mobile,
        protected readonly string $email,
        protected readonly string $govId,
        protected readonly string $fullName,
        protected readonly string $dob,
        protected readonly string $selfiePhoto,
        protected readonly bool $consentGiven,
        protected readonly string $consentedAt,
        protected readonly ?string $motherMaidenName = null,
        protected readonly ?string $familyCardNo = null,
        protected readonly ?string $pob = null,
        protected readonly ?string $address = null,
        protected readonly ?string $village = null,
        protected readonly ?string $district = null,
        protected readonly ?string $city = null,
        protected readonly ?string $province = null,
        protected readonly ?string $partnerTrxId = null,
        protected readonly ?string $idCardPhoto = null,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'mobile' => $this->mobile,
            'email' => $this->email,
            'govId' => $this->govId,
            'fullName' => $this->fullName,
            'dob' => $this->dob,
            'selfiePhoto' => $this->selfiePhoto,
            'ConsentGiven' => $this->consentGiven, // yes capital C, that's what api docs say
            'ConsentedAt' => $this->consentedAt, // yes capital C, that's what api docs say
            'motherMaidenName' => $this->motherMaidenName,
            'familyCardNo' => $this->familyCardNo,
            'pob' => $this->pob,
            'address' => $this->address,
            'village' => $this->village,
            'district' => $this->district,
            'city' => $this->city,
            'province' => $this->province,
            'partnerTrxId' => $this->partnerTrxId,
            'idCardPhoto' => $this->idCardPhoto,
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/kyc';
    }
}
