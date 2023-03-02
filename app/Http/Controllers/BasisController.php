<?php

namespace App\Http\Controllers;

use App\Models\Basis;
use Illuminate\Http\Request;

/**
 * Class BasisController
 * @package App\Http\Controllers
 */
class BasisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bases = Basis::paginate();

        return view('basis.index', compact('bases'))
            ->with('i', (request()->input('page', 1) - 1) * $bases->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $basis = new Basis();
        return view('basis.create', compact('basis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Basis::$rules);

        $basis = Basis::create($request->all());

        return redirect()->route('bases.index')
            ->with('success', 'Basis created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $basis = Basis::find($id);

        return view('basis.show', compact('basis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $basis = Basis::find($id);

        return view('basis.edit', compact('basis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Basis $basis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basis $basis)
    {
        request()->validate(Basis::$rules);

        $basis->update($request->all());

        return redirect()->route('bases.index')
            ->with('success', 'Basis updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $basis = Basis::find($id)->delete();

        return redirect()->route('bases.index')
            ->with('success', 'Basis deleted successfully');
    }
}
