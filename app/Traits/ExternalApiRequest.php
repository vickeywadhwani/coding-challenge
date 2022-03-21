<?php

namespace App\Traits;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

trait ExternalApiRequest
{
    /**
     * call external api.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Client\Response;
     */
    public function get(string $url): Response
    {
        try {
            $response = Http::get($url);
        } catch (\Exception $e) {
            info($e->getMessage());
            abort(503);
        }
        return $response;
    }
}
