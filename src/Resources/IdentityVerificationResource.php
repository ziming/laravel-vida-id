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
    ): Response {
        $authenticator = $this->connector->getAccessToken();
        $token = $authenticator->getAccessToken();

        $request = new WebElectronicKycRequest(
            $mobile,
            $email,
            $govId,
            $fullName,
            $dob,
            $idCardPhoto,
            $partnerTrxId,
        );

        $request->headers()->add('Authorization', 'Bearer ' . $token);

        return $this->connector->send($request);
    }

    public function getIdentityVerificationData(string $eventId): Response
    {
        $authenticator = $this->connector->getAccessToken();
        $token = $authenticator->getAccessToken();

        $request = new GetIdentityVerificationDataRequest($eventId);
        $request->headers()->add('Authorization', 'Bearer ' . $token);

        return $this->connector->send($request);
    }

    public function checkIdentityVerificationStatus(string $eventId): Response
    {
        $authenticator = $this->connector->getAccessToken();
        $token = $authenticator->getAccessToken();

        $request = new CheckIdentityVerificationStatusRequest($eventId);
        $request->headers()->add('Authorization', 'Bearer ' . $token);

        return $this->connector->send($request);
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function performIdentityVerificationRequest(
        string $mobile,
        string $email,
        string $govId,
        string $fullName,
        string $dob,
        string $selfiePhoto,
        bool $consentGiven,
        string $consentedAt,
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
    ): Response {
        // Get the access token
        $authenticator = $this->connector->getAccessToken();
        $token = $authenticator->getAccessToken();

        $request = new PerformIdentityVerificationRequest(
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
        );

        // Add the Authorization header
        $request->headers()->add('Authorization', 'Bearer ' . $token);

        return $this->connector->send($request);
    }
}
