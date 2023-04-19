<?php

namespace App\Http\Controllers;

use App\Models\Base;
use Illuminate\Http\Request;

/**
 * Class BaseController
 * @package App\Http\Controllers
 */
class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bases = Base::paginate();

        return view('base.index', compact('bases'))
            ->with('i', (request()->input('page', 1) - 1) * $bases->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $base = new Base();
        return view('base.create', compact('base'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Base::$rules);

        $base = Base::create($request->all());

        return redirect()->route('bases.index')
            ->with('success', 'Base created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $base = Base::find($id);

        return view('base.show', compact('base'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $base = Base::find($id);

        return view('base.edit', compact('base'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Base $base
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Base $base)
    {
        request()->validate(Base::$rules);

        $base->update($request->all());

        return redirect()->route('bases.index')
            ->with('success', 'Base updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $base = Base::find($id);
        $base->is_active = 0;
        $base->save();

        return redirect()->back()
            ->with('success', 'Base deleted successfully');
    }

    public function restore($id)
    {
        $base = Base::find($id);
        $base->is_active = 1;
        $base->save();

        return redirect()->back()
            ->with('success', 'Base restored successfully');
    }
}
