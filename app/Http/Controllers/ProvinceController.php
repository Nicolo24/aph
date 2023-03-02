<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

/**
 * Class ProvinceController
 * @package App\Http\Controllers
 */
class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::paginate();

        return view('province.index', compact('provinces'))
            ->with('i', (request()->input('page', 1) - 1) * $provinces->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $province = new Province();
        return view('province.create', compact('province'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Province::$rules);

        $province = Province::create($request->all());

        return redirect()->route('provinces.index')
            ->with('success', 'Province created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $province = Province::find($id);

        return view('province.show', compact('province'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $province = Province::find($id);

        return view('province.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Province $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        request()->validate(Province::$rules);

        $province->update($request->all());

        return redirect()->route('provinces.index')
            ->with('success', 'Province updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $province = Province::find($id)->delete();

        return redirect()->route('provinces.index')
            ->with('success', 'Province deleted successfully');
    }
}
