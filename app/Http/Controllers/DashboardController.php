<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    

    public function assign(Request $request){
        $user = Auth::user();
        $assignation = new \App\Models\Assignation();
        $assignation->user_id = $user->id;
        $assignation->base_id = $request->base_id;
        $assignation->resource_id = $request->resource_id;
        $assignation->save();
        return redirect()->route('dashboard');

    }

    public function unassign(Request $request){
        $user = Auth::user();
        $assignation = \App\Models\Assignation::where('id',$request->assignation_id)->first();
        $assignation->is_active = false;
        $assignation->save();
        return redirect()->route('dashboard');
    }

    public function report(Request $request){
        $user = Auth::user();
        $report = new \App\Models\Report();
        $report->user_id = $user->id;
        $report->resource_id = $request->resource_id;
        $report->reporttype_id = $request->reporttype_id;
        $report->comment = $request->comment;
        $report->save();
        return redirect()->route('dashboard');
    }
}
