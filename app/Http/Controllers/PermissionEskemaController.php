<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use GuzzleHttp\Client;

class PermissionEskemaController extends Controller
{
 
    public function acccessobjeto(): View
    {

        $parametros = [
            'usrcod' => 'jean'
        ];
        $url  =env('API_ENDPOINT');
        $token=env('API_TOKEN');
        $client = new Client();
        try {
            $response = $client->request('POST',$url . '/api_servicesapp/mobile/consultaobjetos', [
                'headers' => [
                    'Authorization' => 'Bearer '. $token,
                    'Content-Type' => 'application/json', // Cambia el tipo de contenido según lo que requiera la API
                ],
                'json' => $parametros
            ]);
            $body = $response->getBody()->getContents();

            $data = json_decode($body, true);

            print_r($data);
        }
        catch  (\Exception $e) {
            // Manejar cualquier error que ocurra durante la solicitud
            echo 'Error: ' . $e->getMessage();


        }
        return view('permissioneskema.acccessobjeto', ['data' => $data]);
    }
}
