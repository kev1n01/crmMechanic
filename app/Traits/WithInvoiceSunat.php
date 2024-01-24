<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait WithInvoiceSunat
{
    public function getTokenLoginApi()
    {
        $response = Http::post('https://facturacion.apisperu.com/api/v1/auth/login', [
            'username' => 'kevar01',
            'password' => 'Mermelada2001',
        ]);

        return $response->body();
    }

    public function sendComprobant($data)
    {
        $token = env('APIPERU_TOKEN_CPE');
        $response = Http::withToken($token)->post('https://facturacion.apisperu.com/api/v1/invoice/send', $data);
        // dd($response->json());
        return $response->json('sunatResponse.success');
    }

    public function getComprobantPdf($data)
    {
        $token = env('APIPERU_TOKEN_CPE');
        $response = Http::withToken($token)->post('https://facturacion.apisperu.com/api/v1/invoice/pdf', $data);
        return $response->body();
    }
}
