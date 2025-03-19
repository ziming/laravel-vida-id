<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Resources;

use Saloon\Http\BaseResource;
use Ziming\LaravelVidaId\Requests\Liveness\PerformLivenessCheckRequest;
use Illuminate\Support\Str;

class LivenessResource extends BaseResource
{
    public function performLivenessCheck(
        string $image,
        ?string $partnerTrxId = null,
        bool $imgManipulationCheckEnabled = true
    ) {
        $partnerTrxId ??= Str::uuid()->toString();

        return $this->connector->send(new PerformLivenessCheckRequest(
            image: $image,
            partnerTrxId: $partnerTrxId,
            imgManipulationCheckEnabled: $imgManipulationCheckEnabled
        ));
    }
}