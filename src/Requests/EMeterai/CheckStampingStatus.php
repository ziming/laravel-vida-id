<?php

namespace Ziming\LaravelVidaId\Requests\EMeterai;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CheckStampingStatus extends Request
{
    protected Method $method = Method::GET;

    /*
     * @see https://docs.vida.id/vida-identity-platform/integration-methods/api/emeterai/api-reference/check-status
     */
    public function __construct(
        protected readonly string $refNum,
    )
    {

    }

    protected function defaultHeaders(): array
    {
        return [
            'X-PARTNER-ID' => config('vida-id.client_id'),
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/api/v1/emeterai/docstamp/' . $this->refNum;
    }
}
