<?php

namespace Ziming\LaravelVidaId\Requests\EMeterai;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UploadDocument extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /*
     * @see https://docs.vida.id/vida-identity-platform/integration-methods/api/emeterai/api-reference/upload-document
     */
    public function __construct(
        protected readonly string $codeDocument,
        protected readonly int $page,
        protected readonly int $llx,
        protected readonly int $lly,
        protected readonly string $refNum,
        protected readonly string $document,
    ) {

    }

    protected function defaultBody(): array
    {
        return [
            'codeDocument' => $this->codeDocument,
            'page' => $this->page,
            'llx' => $this->llx,
            'lly' => $this->lly,
            'refNum' => $this->refNum,
            'document' => $this->document,
        ];
    }

    protected function defaultHeaders(): array
    {
        return [
            'X-PARTNER-ID' => config('vida-id.client_id'),
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/api/v1/emeterai/upload';
    }
}
