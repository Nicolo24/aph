<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

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

    

    public function getRoute($id)
    {
        $route = \App\Models\Route::find($id);
        $route->append('status');
        $route->load(['user','resource','locations','resource.resourcetype']);
        return response()->json(['route' => $route]);
    }

    public function obtenerRuta($start_lat,$start_lon,$destination_address)
    {
        $client = new Client();
        $response = $client->get('https://maps.googleapis.com/maps/api/directions/json', [
            'query' => [
                'origin' => $start_lat . ',' . $start_lon,
                'destination' => $destination_address,
                'key' => env('GOOGLE_MAPS_API_KEY'),
            ],
        ]);
        //return shortest route
        $routes = json_decode($response->getBody()->getContents());
        return $routes;
    }

    public function getPossibleRoutes(Request $request)
    {
        $address = $request->input('address');

        //get user->resources where is_available (attribute) = true

        $available_resources = Auth::user()->resources->append(['last_assignation'])->load('institution')->filter(function ($resource) {
            return $resource->is_available;
        });

        $routes = [];

        foreach ($available_resources as $resource) {
            $resource_lat = $resource->last_assignation->base->latitude;
            $resource_lon = $resource->last_assignation->base->longitude;
            $resource_routes= $this->obtenerRuta($resource_lat, $resource_lon, $address);
            $routes[] = [
                'resource' => $resource,
                'routes' => $resource_routes,
                'distance' => $resource_routes->routes[0]->legs[0]->distance->value,
                'distance_text' => $resource_routes->routes[0]->legs[0]->distance->text,
                'time' => $resource_routes->routes[0]->legs[0]->duration->value,
                'time_text' => $resource_routes->routes[0]->legs[0]->duration->text,
            ];
        }

        return response()->json(['routes' => $routes]);


    }

}
