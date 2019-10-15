<?php

namespace App\Http\Controllers;

use App\UnitType;
use Illuminate\Http\Request;
use function Sodium\compare;


class UnitsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unitsType = UnitType::all();
        return view('units-type.index', compact('unitsType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('units-type.create');
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
            'name' => 'required|unique:units_type'
        ]);

        $unitType = new UnitType;
        $unitType->name = $request->name;
        $unitType->save();

        session()->flash('success', '"' . $unitType->name . '" updated successfully!');

        return redirect(route('units-type.index'));
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
     * @param UnitType $unitType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unitType = UnitType::find($id);
        return view('units-type.create', compact('unitType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required | unique:units_type'
        ]);

        $unitType = UnitType::find($id);
        $unitType->name = $request->name;

        $unitType->save();

        session() -> flash('success', '"' . $unitType->name . '" updated successfully!');

        return redirect(route('units-type.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unitType = UnitType::find($id);
        $unitType->delete();

        session() -> flash('success', '"' . $unitType->name . '" deleted successfully!');

        return redirect(route('units-type.index'));
    }
}
