<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;

/**
 * Class CenterController
 * @package App\Http\Controllers
 */
class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers = Center::paginate();

        return view('center.index', compact('centers'))
            ->with('i', (request()->input('page', 1) - 1) * $centers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $center = new Center();
        return view('center.create', compact('center'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Center::$rules);

        $center = Center::create($request->all());

        return redirect()->route('centers.index')
            ->with('success', 'Center created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $center = Center::find($id);

        return view('center.show', compact('center'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $center = Center::find($id);

        return view('center.edit', compact('center'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Center $center
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Center $center)
    {
        request()->validate(Center::$rules);

        $center->update($request->all());

        return redirect()->route('centers.index')
            ->with('success', 'Center updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $center = Center::find($id)->delete();

        return redirect()->route('centers.index')
            ->with('success', 'Center deleted successfully');
    }
}
