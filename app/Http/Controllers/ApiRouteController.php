<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiRouteController extends Controller
{
    //
    public function updateAvailability(Request $request)
    {
        $user = auth()->user();
        $resource = $user->resource;

        if($resource == null) {
            return response()->json(['message' => 'User has no resource'], 400);
        }

        if ($request->has('is_available')) {
            //convert is available to boolean
            $request->is_available = filter_var($request->is_available, FILTER_VALIDATE_BOOLEAN);
            $reporttype = \App\Models\Reporttype::where('is_operative', $request->is_available)->where('in_emergency', false)->first();
            //create new report for availability
            $report = new \App\Models\Report();
            $report->user_id = $user->id;
            $report->reporttype_id = $reporttype->id;
            $report->resource_id = $resource->id;
            //report comment = "user id $user->id set availability to $request->is_available"
            $report->comment = "user id $user->id set availability to $request->is_available from app";
            $report->save();
            return response()->json(['message' => ("Availability of $resource->name set to " . ($request->is_available? 'true':'false'))]);
        }
        else {
            return response()->json(['message' => 'is_available field is required'], 400);
        }
    }

    public function getAvailability()
    {
        //if null resource return false

        $user = auth()->user();
        $resource = $user->resource??null;
        $report = $resource->last_report??null;

        if ($resource == null) {
            return response()->json(['is_available' => false, 'message' => 'No resource']);
        }
        if ($report == null) {
            return response()->json(['is_available' => false, 'message' => "No report yet on $resource->name"]);
        }
        if ($report->reporttype->is_operative && !$report->reporttype->in_emergency) {
            return response()->json(['is_available' => true, 'message' => $report->comment]);
        }
        else {
            return response()->json(['is_available' => false, 'message' => $report->comment]);
        }
    }

    public function getAvailableRoutes()
    {
        $user = auth()->user();
        $routes = $user->available_routes;
        if($routes->count() == 0) {
            return response()->json(['routes'=>$routes, 'message' => 'No available routes']);
        }else {
            return response()->json(['routes'=>$routes, 'message' => 'Available routes']);
        }
    }

    public function startRoute($id)
    {
        //create report for resource with reporttype where in emergency is true
        $reporttype = \App\Models\Reporttype::where('in_emergency', true)->first();
        $user = auth()->user();
        $resource = $user->resource;
        $report = new \App\Models\Report();
        $report->user_id = $user->id;
        $report->reporttype_id = $reporttype->id;
        $report->resource_id = $resource->id;
        $report->comment = "user $user->email started route $id";
        $report->save();
        //update route with user id and start time
        $route = \App\Models\Route::find($id);
        $route->user_id = $user->id;
        $route->start_time = now();
        $route->save();
        return response()->json(['message' => 'Route started']);
    }

    public function informPickedUp($id)
    {
        $user = auth()->user();
        $route = \App\Models\Route::find($id);
        $route->pickup_time = now();
        $route->save();
        return response()->json(['message' => 'Route picked up']);
    }

    public function sendLocation(Request $request, $id)
    {
        $user = auth()->user();
        $route = \App\Models\Route::find($id);
        $location = new \App\Models\Location();
        $location->route_id = $route->id;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->save();
        return response()->json(['message' => 'Location saved']);
    }

    public function endRoute($id)
    {
        $user = auth()->user();
        $route = \App\Models\Route::find($id);
        $route->end_time = now();
        $route->save();
        return response()->json(['message' => 'Route finished']);
    }

    public function getPoints($id)
    {
        $route = \App\Models\Route::find($id);
        $points = $route->locations->map(function($location) {
            return [$location->latitude, $location->longitude];
        });
        return response()->json(['points' => $points]);
    }
}