<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;

/**
 * Class InstitutionController
 * @package App\Http\Controllers
 */
class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institution::paginate();

        return view('institution.index', compact('institutions'))
            ->with('i', (request()->input('page', 1) - 1) * $institutions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institution = new Institution();
        return view('institution.create', compact('institution'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Institution::$rules);

        $institution = Institution::create($request->all());

        return redirect()->route('institutions.index')
            ->with('success', 'Institution created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $institution = Institution::find($id);

        return view('institution.show', compact('institution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institution = Institution::find($id);

        return view('institution.edit', compact('institution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Institution $institution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institution $institution)
    {
        request()->validate(Institution::$rules);

        $institution->update($request->all());

        return redirect()->route('institutions.index')
            ->with('success', 'Institution updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $institution = Institution::find($id)->delete();

        return redirect()->route('institutions.index')
            ->with('success', 'Institution deleted successfully');
    }
}
