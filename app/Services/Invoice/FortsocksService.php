<?php
namespace App\Services\Invoice;

use App\Models\CapacitoInvoice;
use App\Models\CapacitoInvoiceDates;
use App\Models\CapacitoInvoiceRow;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class FortsocksService extends InvoiceBase
{
    private $config;

    /**
     * Constructor
     * @param  array  $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * getter for config
     * @return  array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Convert fortsocks invoice to CapacitoInvoice
     *
     * @param  array  $invoice
     * @return \App\Models\CapacitoInvoice;
     */
    public function toCapacitoInvoice(array $invoice): CapacitoInvoice
    {
        $capInvoice = new CapacitoInvoice();
        $capInvoiceDates = new CapacitoInvoiceDates();
        $capacitoInvoiceRow = new CapacitoInvoiceRow();
        $capInvoiceRows = new Collection;
        $capInvoice->id = $invoice['id'];
        $capInvoice->invoice_nr = $invoice['invoice-nr'];
        $capInvoice->currency = $invoice['currency'];
        $capInvoice->total_amount = $invoice['amount'];
        $capInvoice->custom_note = $invoice['notes'];
        $capInvoiceDates->created_at = $invoice['invoice-date'];
        $capInvoiceDates->updated_at = $invoice['invoice-date'];
        $capInvoiceDates->issue_date = $invoice['delivery-date'];
        $capInvoiceDates->due_date = $invoice['invoice-date'];
        $capInvoice->dates = $capInvoiceDates;
        
        foreach ($invoice['rows'] as $row) {
            $capacitoInvoiceRow->article_name = $row['product-name'];
            $capacitoInvoiceRow->quantity = $row['quantity'];
            $capacitoInvoiceRow->price = $row['price'];
            $capInvoiceRows->push($capacitoInvoiceRow);
        }
        $capInvoice->rows = $capInvoiceRows;
        return $capInvoice;
    }
}
