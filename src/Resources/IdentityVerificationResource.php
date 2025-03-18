<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Resources;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Ziming\LaravelVidaId\Requests\IdentityVerification\CheckIdentityVerificationStatusRequest;
use Ziming\LaravelVidaId\Requests\IdentityVerification\GetIdentityVerificationDataRequest;
use Ziming\LaravelVidaId\Requests\IdentityVerification\PerformIdentityVerificationRequest;
use Ziming\LaravelVidaId\Requests\IdentityVerification\WebElectronicKycRequest;

class IdentityVerificationResource extends BaseResource
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function webElectronicKyc(
        string $mobile,
        string $email,
        string $govId,
        string $fullName,
        string $dob,
        string $idCardPhoto,
        string $partnerTrxId,
    ): Response
    {
        return $this->connector->send(new WebElectronicKycRequest(
            $mobile,
            $email,
            $govId,
            $fullName,
            $dob,
            $idCardPhoto,
            $partnerTrxId,
        ));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function getIdentityVerificationData(string $eventId): Response
    {
        return $this->connector->send(new GetIdentityVerificationDataRequest($eventId));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function checkIdentityVerificationStatus(string $eventId): Response
    {
        return $this->connector->send(new CheckIdentityVerificationStatusRequest($eventId));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function performIdentityVerificationRequest(
        string  $mobile,
        string  $email,
        string  $govId,
        string  $fullName,
        string  $dob,
        string  $selfiePhoto,
        bool    $consentGiven,
        string  $consentedAt,
        ?string $motherMaidenName = null,
        ?string $familyCardNo = null,
        ?string $pob = null,
        ?string $address = null,
        ?string $village = null,
        ?string $district = null,
        ?string $city = null,
        ?string $province = null,
        ?string $partnerTrxId = null,
        ?string $idCardPhoto = null,
    ): Response
    {
        return $this->connector->send(new PerformIdentityVerificationRequest(
            $mobile,
            $email,
            $govId,
            $fullName,
            $dob,
            $selfiePhoto,
            $consentGiven,
            $consentedAt,
            $motherMaidenName,
            $familyCardNo,
            $pob,
            $address,
            $village,
            $district,
            $city,
            $province,
            $partnerTrxId,
            $idCardPhoto,
        ));
    }
}
