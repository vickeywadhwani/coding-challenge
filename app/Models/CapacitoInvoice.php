<?php

namespace App\Models;

use Illuminate\Support\Collection;
use App\Models\CapacitoInvoiceDates;

class CapacitoInvoice
{
    public string $id;
    public string $invoice_nr;
    public CapacitoInvoiceDates $dates;
    public string $currency;
    public int $total_amount;
    public ?string $custom_note=null;
    public Collection $rows;
}
