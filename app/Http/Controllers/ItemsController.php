<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ItemsController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $client = new Client();
        $response = $client->get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
            'query' => [
                'query' => $query,
                'key' => env('GOOGLE_MAPS_API_KEY'),
            ],
        ]);

        $items = json_decode($response->getBody()->getContents());

        return response()->json($items);
    }
}
