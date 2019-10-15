<?php

namespace App\Http\Controllers;

use App\Unit;
use App\UnitType;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        return view('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unitsType = UnitType::all();
        return view('units.create', compact('unitsType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | unique:units',
            'type' => 'required',
            'symbol' => 'required | unique:units',
            'default' => 'required'
        ]);

        $unit = new Unit;
        $unit->name = $request->name;
        $unit->type = $request->type;
        $unit->symbol = $request->symbol;
        $unit->default = $request->default;

        $unit->save();

        session()->flash('success', '"' . $unit->name . '" created successfully!');

        return redirect(route('units.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::find($id);
        $unitsType = UnitType::all();
        return view('units.edit', compact('unit', 'unitsType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'symbol' => 'required',
            'default' => 'required'
        ]);

        $unit = Unit::find($id);

        $unit->name = $request->name;
        $unit->type = $request->type;
        $unit->symbol = $request->symbol;
        $unit->default = $request->default;

        $unit->save();

        session()->flash('success', '"' . $unit->name . '" updated successfully!');

        return redirect(route('units.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();

        session()->flash('success', '"' . $unit->name . '" deleted successfully!');

        return redirect(route('units.index'));
    }
}
