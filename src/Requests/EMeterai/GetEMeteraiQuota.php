<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Requests\EMeterai;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetEMeteraiQuota extends Request
{
    protected Method $method = Method::GET;

    /*
     * @see https://docs.vida.id/vida-identity-platform/integration-methods/api/emeterai/api-reference/get-quota
     */
    public function __construct() {}

    protected function defaultHeaders(): array
    {
        return [
            'X-PARTNER-ID' => config('vida-id.client_id'),
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/api/v1/emeterai/quota';
    }
}
