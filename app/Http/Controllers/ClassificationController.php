<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporttype;
use App\Models\Resourcetype;
use App\Models\Basetype;
use App\Models\Usertype;

class ClassificationController extends Controller
{
    public function index()
    {
        $reporttypes = Reporttype::all();
        $resourcetypes = Resourcetype::all();
        $basetypes = Basetype::all();
        $usertypes = Usertype::all();
        return view('classification.index', compact('reporttypes', 'resourcetypes', 'basetypes', 'usertypes'));
    }
}
