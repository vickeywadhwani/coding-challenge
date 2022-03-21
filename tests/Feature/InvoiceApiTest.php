<?php
    
namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;
    
class InvoiceApiTests extends TestCase
{
    public function testHtppStatus200()
    {
        $response = $this->getJson('/api/invoice/vizma/1');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'invoice_nr',
            'dates'=> [
                'created_at',
                'updated_at',
                'issue_date',
                'due_date',
            ],
            'currency',
            'total_amount',
            'custom_note',
            'rows'=>[
                '*' => [
                    'article_name',
                    'quantity',
                    'price',
                ]
            ],
        ]);
    }

    public function testHtppStatus404()
    {
        $response = $this->call('GET', '/api/invoice/vizma/2');

        $response->assertStatus(404);
    }

    public function testHtppStatus500()
    {
        $response = $this->call('GET', '/api/invoice/vizma2/2');

        $response->assertStatus(404);
    }
}
