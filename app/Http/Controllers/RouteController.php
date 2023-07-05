<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

/**
 * Class RouteController
 * @package App\Http\Controllers
 */
class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Route::paginate();

        return view('route.index', compact('routes'))
            ->with('i', (request()->input('page', 1) - 1) * $routes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request  $request)
    {
        //if request has resource_id, then we are creating a route for a resource
        if($request->has('resource_id')){

            $resource= \App\Models\Resource::find($request->resource_id);
            // if resource->last_report->is_active=true, then we are creating a route for a resource with an active report
            if(
                $resource->last_report && 
                $resource->last_report->reporttype->is_operative && 
                !$resource->last_report->reporttype->in_emergency
            ){
                $route = new Route();
                $route->resource_id = $request->resource_id;
                //if resource has last_assignation, and last assignation->is active = true, then we are creating a route for a resource with an assignation
                if($resource->last_assignation && $resource->last_assignation->is_active){
                    $route->start_address = $resource->last_assignation->base->name;
                    $route->start_latitude = $resource->last_assignation->base->latitude;
                    $route->start_longitude = $resource->last_assignation->base->longitude;
                    $route->destination_address = $resource->last_assignation->base->name;
                    $route->destination_latitude = $resource->last_assignation->base->latitude;
                    $route->destination_longitude = $resource->last_assignation->base->longitude;
                }
                else{
                    $warning = "El recurso no esta asignado a ninguna base, especifique manualmente las direcciones de inicio y destino";
                    return view('route.create', compact('route', 'warning'));
                }
            }
            else{
                // return back with warning = "El recurso no puede ser asignado porque no esta operativo"
                return redirect()->back()
                    ->with('warning', 'El recurso no puede ser asignado porque no esta operativo o esta en una emergencia');
            }
            
        }else{
            $route = new Route();
        }
        return view('route.create', compact('route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Route::$rules);

        $route = Route::create($request->all());

        $user = \Auth::user();
        $reporttype = \App\Models\Reporttype::where('is_operative', true)->where('in_emergency', true)->first();
        $report = new \App\Models\Report();
        $report->user_id = $user->id;
        $report->resource_id = $route->resource_id;
        $report->reporttype_id = $reporttype->id;
        $report->comment = <<<EOD
        Start: $request->start_address
        Emergency: $request->emergency_address
        End: $request->destination_address
        Instrucciones: $request->instructions
        Route: $route->id
        EOD;
        $report->save();


        return redirect()->route('routes.show', $route->id)
            ->with('success', 'Route created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = Route::find($id);

        return view('route.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route = Route::find($id);

        return view('route.edit', compact('route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Route $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Route $route)
    {
        request()->validate(Route::$rules);

        $route->update($request->all());

        return redirect()->route('routes.index')
            ->with('success', 'Route updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $route = Route::find($id)->delete();

        return redirect()->route('routes.index')
            ->with('success', 'Route deleted successfully');
    }
}
