<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class PermissionEskemaController extends Controller
{

    public function acccessobjeto(): View
    {
        $parametros = [
            'usrcod' => Auth::user()->name
        ];
        $url   = config('services.eskema.endpoint');
        $token = config('services.eskema.token');
        $client = new Client();
        $data = [];

        try {
            $response = $client->request('POST', $url . '/api_servicesapp/mobile/consultaobjetos', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type'  => 'application/json',
                ],
                'json' => $parametros
            ]);

            $data = json_decode($response->getBody()->getContents(), true) ?? [];
        } catch (\Exception $e) {
            Log::error('Error consultando API Eskema: ' . $e->getMessage());
        }

        return view('permissioneskema.acccessobjeto', ['data' => $data]);
    }
}
