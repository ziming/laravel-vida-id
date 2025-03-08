<?php

declare(strict_types=1);

namespace Ziming\LaravelVidaId\Requests\IncomeVerification;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class PerformIncomeVerificationRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /*
     * @see https://docs.vida.id/vida-identity-platform/integration-methods/api/income-verification/api-reference/income-verification
     */
    public function __construct(
        protected readonly string $partnerTrxId,
        protected readonly string $nik,
        protected readonly string $incomePeriod, // MM/YYYY
        protected readonly int $incomeValue, // exact income value
        protected readonly string $companyName,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'partnerTrxId' => $this->partnerTrxId,
            'nik' => $this->nik,
            'incomePeriod' => $this->incomePeriod,
            'incomeValue' => $this->incomeValue,
            'companyName' => $this->companyName,
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/income-verification/transaction';
    }
}
