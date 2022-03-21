<?php
namespace App\Managers\Invoice;

use Illuminate\Foundation\Application;
use App\Services\Invoice\InvoiceService;
use Illuminate\Support\Arr;

class InvoiceManager implements IntInvoiceManager
{
    private $providers = [];

    private $app;

    /**
     * Constructor
     * @param  Application  $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * return api provider .
     *
     * @param  string  $name
     * @return \App\Services\Invoice\InvoiceService;
     */
    public function make(string $name): InvoiceService
    {
        $service = Arr::get($this->providers, $name);

        // No need to create the service every time
        if ($service) {
            return $service;
        }

        $config = $this->app['config']['invproviders.'.$name];
        if (empty($config)) {
            throw new \Exception("Api $name is not supported");
        }
        
        // create the required object -
        $service = new $config['service']($config);

        $this->providers[$name] = $service;

        return $service;
    }
}
