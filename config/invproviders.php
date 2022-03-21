<?php

return [

    'vizma' => [
        'service' => App\Services\Invoice\VizmaService::class,
        'end_point' => 'https://qa-app.capcito.com/api/v3/work-sample/invoices/vizma/'
    ],

    'fortsocks' => [
        'service' => App\Services\Invoice\FortsocksService::class,
        'end_point' => 'https://qa-app.capcito.com/api/v3/work-sample/invoices/fortsocks/'
    ]

];
