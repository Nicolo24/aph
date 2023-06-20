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
    public function getAllPlaces(Request $request)
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
//GET method to get all geocodes
    public function getAllGeocodes(Request $request)
    {
        $address = $request->input('address');
        $client = new Client();
        $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json'
            . '?address=' . $address
            . '&region=ec'
            . '&key=' . env('GOOGLE_MAPS_API_KEY')
        );
        $items = json_decode($response->getBody()->getContents());
        return response()->json($items);

    }

    public function getOneGeocode(Request $request)
    {
        $address = $request->input('address');
        $client = new Client();
        //limit the bnumber of results to 1
        $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json'
            . '?address=' . $address
            . '&region=ec'
            . '&key=' . env('GOOGLE_MAPS_API_KEY')
            . '&limit=1'
        );
        $items = json_decode($response->getBody()->getContents());
        return response()->json($items);
    }

    public function getReverseGeocode(Request $request)
    {
        $latlng = $request->input('latlng');
        $client = new Client();
        //limit the bnumber of results to 1
        $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json'
            . '?latlng=' . $latlng
            . '&region=ec'
            . '&key=' . env('GOOGLE_MAPS_API_KEY')
            . '&limit=1'
        );
        $items = json_decode($response->getBody()->getContents());
        return response()->json($items);
    }
}
