<?php
namespace App\Services\Invoice;

use F9Web\ApiResponseHelpers;
use App\Models\CapacitoInvoice;
use Illuminate\Http\JsonResponse;
use App\Traits\ExternalApiRequest;

abstract class InvoiceBase implements InvoiceService
{
    use ExternalApiRequest, ApiResponseHelpers;

    abstract public function toCapacitoInvoice(array $invoice): CapacitoInvoice;
    abstract public function getConfig(): array;

    /**
     * return response from Fortsocks api.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse;
     */
    public function getInvoice(string $id): JsonResponse
    {
        $config = $this->getConfig();
        $res = $this->get($config['end_point'].$id);
        if ($res->successful()) {
            $invoice = (array) $this->toCapacitoInvoice($res->json());
            $response = $this->respondWithSuccess($invoice);
        } else {
            $response = $this->respondNotFound("Resource not found");
        }
        return $response;
    }
}
