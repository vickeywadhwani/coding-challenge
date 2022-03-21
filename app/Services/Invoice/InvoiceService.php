<?php
namespace App\Services\Invoice;

use Illuminate\Http\JsonResponse;

interface InvoiceService
{
    public function getInvoice(string $id): JsonResponse;
}
