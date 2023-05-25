<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait WithFacturaSunat
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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2Nzc1MTE0NTIsImV4cCI6NDgzMTExMTQ1MiwidXNlcm5hbWUiOiJrZXZhcjAxIiwiY29tcGFueSI6IjIwNDIyMzQ4OTIxIn0.mHI8_aGXBYqqjkC0P0LAP1aJqSsjENyP6u9SN682p56To9pzuCP9DRKmqdxVbNvRM53ZTWntCIT5FMXeM8lG8PegG5lB_HBmj2JryysbIOncV6LBOmlivuIwv6Iw14WRcrRe0S56Wyn6xLDbDhDBPLUMpSnlKScuGx9vG_dTddZ21RWZv6va3KfyCRWs4EAA1iqxoz8gI7xz2PMllmtMjPUsEFXPOONsYE-L8dB4gxyHVLjcFgHVv9rpQOWgVf74e96vmPlr5KqvbNuE-3cEDeizKyu0kgL0bhKL5SMjl-2kPvTE5_GuYS1Jzo5jd279ha-sbzpv-gSzM1oSi8QJUn01dyitN6mK8B0BgBBVwwma8tPFulX9y0107L9sLF_UKKXk9RoSSE4du7R5HjpvUO4qZGjWDZdCAtJ4pKwTEigsO97gfzFQi9OLIKNX89XBeg8fB0JU7nmG4Eel8Ck_UxDGJc4cqcQecnbOYOUdYvtloCePB7to9_2b-9XrBdCkEUtZf8YFL6tW_4DAPPIxQXNOCY7p6s_xsMRykVtgP92sANwNRB4zk2J_cUay3IwBGuyrF2qoEs6oVxA2TjZanhkEuzfy0UNUUsBSnApCDCaY4aoWrKgEvW_gmLue2_-SXInCNkkmOPMtwjRZAtIu82EHSuG84KZq4xDiU18hLy8';
        $response = Http::withToken($token)->post('https://facturacion.apisperu.com/api/v1/invoice/send', $data);
        return $response->json('sunatResponse.success');
    }

    public function getComprobantPdf($data)
    {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2Nzc1MTE0NTIsImV4cCI6NDgzMTExMTQ1MiwidXNlcm5hbWUiOiJrZXZhcjAxIiwiY29tcGFueSI6IjIwNDIyMzQ4OTIxIn0.mHI8_aGXBYqqjkC0P0LAP1aJqSsjENyP6u9SN682p56To9pzuCP9DRKmqdxVbNvRM53ZTWntCIT5FMXeM8lG8PegG5lB_HBmj2JryysbIOncV6LBOmlivuIwv6Iw14WRcrRe0S56Wyn6xLDbDhDBPLUMpSnlKScuGx9vG_dTddZ21RWZv6va3KfyCRWs4EAA1iqxoz8gI7xz2PMllmtMjPUsEFXPOONsYE-L8dB4gxyHVLjcFgHVv9rpQOWgVf74e96vmPlr5KqvbNuE-3cEDeizKyu0kgL0bhKL5SMjl-2kPvTE5_GuYS1Jzo5jd279ha-sbzpv-gSzM1oSi8QJUn01dyitN6mK8B0BgBBVwwma8tPFulX9y0107L9sLF_UKKXk9RoSSE4du7R5HjpvUO4qZGjWDZdCAtJ4pKwTEigsO97gfzFQi9OLIKNX89XBeg8fB0JU7nmG4Eel8Ck_UxDGJc4cqcQecnbOYOUdYvtloCePB7to9_2b-9XrBdCkEUtZf8YFL6tW_4DAPPIxQXNOCY7p6s_xsMRykVtgP92sANwNRB4zk2J_cUay3IwBGuyrF2qoEs6oVxA2TjZanhkEuzfy0UNUUsBSnApCDCaY4aoWrKgEvW_gmLue2_-SXInCNkkmOPMtwjRZAtIu82EHSuG84KZq4xDiU18hLy8';
        $response = Http::withToken($token)->post('https://facturacion.apisperu.com/api/v1/invoice/pdf', $data);

        return $response->body();
    }
}
