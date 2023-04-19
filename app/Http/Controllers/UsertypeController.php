<?php

namespace App\Http\Controllers;

use App\Models\Usertype;
use Illuminate\Http\Request;

/**
 * Class UsertypeController
 * @package App\Http\Controllers
 */
class UsertypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usertype = new Usertype();
        return view('usertype.create', compact('usertype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Usertype::$rules);

        $usertype = Usertype::create($request->all());

        return redirect()->route('classifications.index')
            ->with('usertypesuccess', 'Usertype created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usertype = Usertype::find($id);

        return view('usertype.show', compact('usertype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usertype = Usertype::find($id);

        return view('usertype.edit', compact('usertype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Usertype $usertype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usertype $usertype)
    {
        request()->validate(Usertype::$rules);

        $usertype->update($request->all());

        return redirect()->route('classifications.index')
            ->with('usertypesuccess', 'Usertype updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $usertype = Usertype::find($id)->delete();

        return redirect()->route('classifications.index')
            ->with('usertypesuccess', 'Usertype deleted successfully');
    }
}
