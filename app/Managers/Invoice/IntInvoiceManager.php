<?php
namespace App\Managers\Invoice;

use App\Services\Invoice\InvoiceService;

interface IntInvoiceManager
{
    public function make(string $name): InvoiceService;
}
