<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Resources;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Ziming\LaravelVidaId\Requests\DocumentAi\DocumentAiVerificationRequest;
use Illuminate\Support\Str;

class DocumentAiResource extends BaseResource
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function verifyDocument(
        string $idFrontSideImage,
        ?string $partnerTrxId = null,
        ?string $groupId = null,
        string $idType = 'ID_CARD',
        string $country = 'IDN',
        string $idSubtype = 'KTP',
    ): Response {
        // Get the access token first
        $authenticator = $this->connector->getAccessToken();
        $token = $authenticator->getAccessToken();

        $request = new DocumentAiVerificationRequest(
            partnerTrxId: $partnerTrxId ?? Str::uuid()->toString(),
            groupId: $groupId ?? Str::uuid()->toString(),
            idFrontSideImage: $idFrontSideImage,
            userIp: request()->ip(),
            obtainedAt: (string) time(),
            idType: $idType,
            country: $country,
            idSubtype: $idSubtype,
        );

        // Add the Authorization header
        $request->headers()->add('Authorization', 'Bearer ' . $token);

        return $this->connector->send($request);
    }
}
