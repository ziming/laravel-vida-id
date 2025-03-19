<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Requests\Liveness;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class PerformLivenessCheckRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /*
     * @see https://docs.vida.id/vida-identity-platform/integration-methods/api/liveness/api-reference/liveness-check
     */
    public function __construct(
        protected readonly string $image,
        protected readonly ?string $partnerTrxId = null, // the api docs say it is required & also optional. Confusing
        protected readonly bool $imgManipulationCheckEnabled = true,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'image' => $this->image,
            'partnerTrxId' => $this->partnerTrxId,
            'imgManipulationCheckEnabled' => $this->imgManipulationCheckEnabled,
        ];
    }

    public function resolveEndpoint(): string
    {
        return 'services/face/liveliness';
    }
}
