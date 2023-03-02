<?php

namespace App\Http\Controllers;

use App\Models\Basetype;
use Illuminate\Http\Request;

/**
 * Class BasetypeController
 * @package App\Http\Controllers
 */
class BasetypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $basetypes = Basetype::paginate();

        return view('basetype.index', compact('basetypes'))
            ->with('i', (request()->input('page', 1) - 1) * $basetypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $basetype = new Basetype();
        return view('basetype.create', compact('basetype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Basetype::$rules);

        $basetype = Basetype::create($request->all());

        return redirect()->route('basetypes.index')
            ->with('success', 'Basetype created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $basetype = Basetype::find($id);

        return view('basetype.show', compact('basetype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $basetype = Basetype::find($id);

        return view('basetype.edit', compact('basetype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Basetype $basetype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basetype $basetype)
    {
        request()->validate(Basetype::$rules);

        $basetype->update($request->all());

        return redirect()->route('basetypes.index')
            ->with('success', 'Basetype updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $basetype = Basetype::find($id)->delete();

        return redirect()->route('basetypes.index')
            ->with('success', 'Basetype deleted successfully');
    }
}
