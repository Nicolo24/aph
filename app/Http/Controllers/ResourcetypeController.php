<?php

namespace App\Http\Controllers;

use App\Models\Resourcetype;
use Illuminate\Http\Request;

/**
 * Class ResourcetypeController
 * @package App\Http\Controllers
 */
class ResourcetypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resourcetypes = Resourcetype::paginate();

        return view('resourcetype.index', compact('resourcetypes'))
            ->with('i', (request()->input('page', 1) - 1) * $resourcetypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resourcetype = new Resourcetype();
        return view('resourcetype.create', compact('resourcetype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Resourcetype::$rules);

        $resourcetype = Resourcetype::create($request->all());

        return redirect()->route('resourcetypes.index')
            ->with('success', 'Resourcetype created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resourcetype = Resourcetype::find($id);

        return view('resourcetype.show', compact('resourcetype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resourcetype = Resourcetype::find($id);

        return view('resourcetype.edit', compact('resourcetype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Resourcetype $resourcetype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resourcetype $resourcetype)
    {
        request()->validate(Resourcetype::$rules);

        $resourcetype->update($request->all());

        return redirect()->route('resourcetypes.index')
            ->with('success', 'Resourcetype updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $resourcetype = Resourcetype::find($id)->delete();

        return redirect()->route('resourcetypes.index')
            ->with('success', 'Resourcetype deleted successfully');
    }
}
