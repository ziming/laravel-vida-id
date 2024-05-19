<?php

namespace Ziming\LaravelVidaId\Requests\SignIFrame;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetSigningStatusRequest extends Request
{
    protected Method $method = Method::GET;

    /*
     * @see https://docs.vida.id/vida-identity-platform/integration-methods/api/sign-iframe/api-reference/status
     */
    public function __construct(
        protected readonly string $eSignId,
    ) {

    }

    public function resolveEndpoint(): string
    {
        return '/'.$this->eSignId;
    }
}
