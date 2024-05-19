<?php

namespace Ziming\LaravelVidaId\Requests\SignInline;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GetDigitalSignatureTransactionStatusRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    /*
     * @see https://docs.vida.id/vida-identity-platform/integration-methods/api/sign-inline/api-reference/digital-signature-transaction-status
     */
    public function __construct(
        protected readonly string $eSignId,
        protected readonly string $name,
        protected readonly int $age,
    )
    {

    }

    protected function defaultHeaders(): array
    {
        return [
            'name' => $this->name,
            'age' => $this->age,
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/' . $this->eSignId;
    }
}
