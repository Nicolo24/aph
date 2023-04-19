<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoricController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){
        if($request->has(['institution_id','zone_id','province_id','center_id','when'])){
            $institution_id = $request->institution_id;
            $zone_id = $request->zone_id;
            $province_id = $request->province_id;
            $center_id = $request->center_id;
            $when = \Carbon\Carbon::parse($request->when)->addHours(5);
            $resources = \App\Models\Resource::where("institution_id", $institution_id)->where("zone_id", $zone_id)->where("province_id", $province_id)->where("center_id", $center_id)->where("is_active",true)->get();
          
        }
        else{
            $resources = \App\Models\Resource::where("is_active",true)->get();
        }

        return view('historic')->with(['resources' => $resources,'request'=>$request->all(),'when'=>$when??Carbon::now()]);
    }
}