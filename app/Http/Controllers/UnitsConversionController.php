<?php

namespace App\Http\Controllers;

use App\Unit;
use App\UnitConversion;
use App\UnitType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitsConversionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unitsConversion = UnitConversion::all();
        return view('units-conversion.index', compact('unitsConversion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unitsType = UnitType::all();
        $units = Unit::all();
        return view('units-conversion.create', compact('units', 'unitsType'));
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
            'from_code' => 'required',
            'to_code' => 'required',
            'value' => 'required',
            'type_id' => 'required'
        ]);

        $unitsConversion = new UnitConversion;
        $unitsConversion->from_code = $request->from_code;
        $unitsConversion->type_id = $request->type_id;
        $unitsConversion->to_code = $request->to_code;
        $unitsConversion->value = $request->value;

        $unitsConversion->checksum = md5($unitsConversion->from_code.$unitsConversion->to_code);
        $check = UnitConversion::where('checksum', $unitsConversion->checksum)->first();
        if ($check){
            return redirect()->back()->withErrors('Unit Conversion already exist!');
        }

        $unitsConversion->save();

        session()->flash('success', 'Unit Conversion created successfully!');

        return redirect(route('units-conversion.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unitsType = UnitType::all();
        $units = Unit::all();
        $unitConversion = UnitConversion::find($id);
        return view('units-conversion.edit', compact('units', 'unitConversion', 'unitsType'));
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
            'from_code' => 'required',
            'to_code' => 'required',
            'value' => 'required',
            'type_id' => 'required'
        ]);

        $unitConversion = UnitConversion::find($id);

        $unitConversion->from_code = $request->from_code;
        $unitConversion->to_code = $request->to_code;
        $unitConversion->value = $request->value;
        $unitConversion->type_id = $request->type_id;
        $unitConversion->save();

        session()->flash('success', 'Unit Conversion updated successfully!');

        return redirect(route('units-conversion.index', compact('unitConversion')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uniConversion = UnitConversion::find($id);
        $uniConversion->delete();

        session()->flash('success', 'Unit Conversion deleted successfully!');

        return redirect(route('units-conversion.index'));
    }

    public function ajaxCreate(Request $request){
        $units = DB::table('units')->where('type', $request->id)->get();
        $html='<div class="form-group">';
        $html.='<label for="from_code">From Code</label>';
        $html.='<select name="from_code" id="from_code" class="form-control">';
        foreach($units as $unit){
            $html .= '<option value="'.$unit->type.'">'.$unit->symbol.'</option>';
        }
        $html.='</select>';
        $html.='</div>';
        $html.='<div class="form-group">';
        $html.='<label for="to_code">To Code</label>';
        $html.='<select name="to_code" id="to_code" class="form-control">';
        foreach($units as $unit){
            $html .= '<option value="'.$unit->type.'">'.$unit->symbol.'</option>';
        }
        $html.='</select>';
        $html.='</div>';
        echo $html;
    }

    public function ajaxEdit(Request $request){
//        dd(1);
        $unitsEdit = DB::table('units')->where('type', $request->id)->get();
        $unitConversion = DB::table('units-convertion')->where('type_id', $request->id)->get();
        $html='<div class="form-group">';
        $html.='<label for="from_code">From Code</label>';
        $html.='<select name="from_code" id="from_code" class="form-control">';
        foreach($unitsEdit as $unitEdit){
            $html .= '<option value="'.$unitEdit->type.'">'.$unitEdit->symbol.'</option>';
            $selected = null;
            if ($unitEdit->symbol==$unitConversion->from_code){
                $selected = "selected";
            }
            $html .= '<option value="'.$unitEdit->symbol.'"'.$selected.'>'.$unitsEdit->symbol.'</option>';
        }
//        dd($html);
        $html.='</select>';
        $html.='</div>';
        $html.='<div class="form-group">';
        $html.='<label for="to_code">To Code</label>';
        $html.='<select name="to_code" id="to_code" class="form-control">';
        foreach($unitsEdit as $unitEdit){
            $html .= '<option value="'.$unitEdit->type.'">'.$unitEdit->symbol.'</option>';
        }
        $html.='</select>';
        $html.='</div>';
        echo $html;
    }
}
