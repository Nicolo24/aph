<?php

namespace App\Http\Controllers;

use App\Models\Assignation;
use Illuminate\Http\Request;

/**
 * Class AssignationController
 * @package App\Http\Controllers
 */
class AssignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignations = Assignation::orderBy('created_at','desc')->paginate();

        return view('assignation.index', compact('assignations'))
            ->with('i', (request()->input('page', 1) - 1) * $assignations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assignation = new Assignation();
        return view('assignation.create', compact('assignation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Assignation::$rules);

        $assignation = Assignation::create($request->all());

        return redirect()->route('assignations.index')
            ->with('success', 'Assignation created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignation = Assignation::find($id);

        return view('assignation.show', compact('assignation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assignation = Assignation::find($id);

        return view('assignation.edit', compact('assignation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Assignation $assignation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignation $assignation)
    {
        request()->validate(Assignation::$rules);

        $assignation->update($request->all());

        return redirect()->route('assignations.index')
            ->with('success', 'Assignation updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $assignation = Assignation::find($id)->delete();

        return redirect()->route('assignations.index')
            ->with('success', 'Assignation deleted successfully');
    }
}
