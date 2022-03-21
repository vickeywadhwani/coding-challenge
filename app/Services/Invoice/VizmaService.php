<?php
namespace App\Services\Invoice;

use App\Models\CapacitoInvoice;
use App\Models\CapacitoInvoiceDates;
use App\Models\CapacitoInvoiceRow;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class VizmaService extends InvoiceBase
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
     * Convert vizma invoice to CapacitoInvoice
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
        $capInvoice->id = $invoice['Id'];
        $capInvoice->invoice_nr = $invoice['InvoiceNumber'];
        $capInvoice->currency = $invoice['CurrencyCode'];
        $capInvoice->total_amount = $invoice['TotalAmount'];
        $capInvoice->custom_note = $invoice['YourReference'];
        $capInvoiceDates->created_at = $invoice['InvoiceDate'];
        $capInvoiceDates->updated_at = $invoice['InvoiceDate'];
        $capInvoiceDates->issue_date = $invoice['InvoiceDate'];
        $capInvoiceDates->due_date = $invoice['DueDate'];
        $capInvoice->dates = $capInvoiceDates;
        
        foreach ($invoice['Rows'] as $row) {
            $capacitoInvoiceRow->article_name = $row['Text'];
            $capacitoInvoiceRow->quantity = $row['Quantity'];
            $capacitoInvoiceRow->price = $row['UnitPrice'];
            $capInvoiceRows->push($capacitoInvoiceRow);
        }
        $capInvoice->rows = $capInvoiceRows;
        return $capInvoice;
    }
}
