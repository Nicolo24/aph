<?php

namespace App\Http\Controllers;

use App\Models\Reporttype;
use Illuminate\Http\Request;

/**
 * Class ReporttypeController
 * @package App\Http\Controllers
 */
class ReporttypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reporttypes = Reporttype::paginate();

        return view('reporttype.index', compact('reporttypes'))
            ->with('i', (request()->input('page', 1) - 1) * $reporttypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reporttype = new Reporttype();
        return view('reporttype.create', compact('reporttype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Reporttype::$rules);

        $reporttype = Reporttype::create($request->all());

        return redirect()->route('reporttypes.index')
            ->with('success', 'Reporttype created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reporttype = Reporttype::find($id);

        return view('reporttype.show', compact('reporttype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reporttype = Reporttype::find($id);

        return view('reporttype.edit', compact('reporttype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Reporttype $reporttype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reporttype $reporttype)
    {
        request()->validate(Reporttype::$rules);

        $reporttype->update($request->all());

        return redirect()->route('reporttypes.index')
            ->with('success', 'Reporttype updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $reporttype = Reporttype::find($id)->delete();

        return redirect()->route('reporttypes.index')
            ->with('success', 'Reporttype deleted successfully');
    }
}
