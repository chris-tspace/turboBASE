<?php

namespace App\Http\Controllers;

use App\AircraftType;
use App\EngineType;
use Illuminate\Http\Request;

class AircraftTypeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aircraftTypes = AircraftType::orderBy('type', 'asc')->get();

        return view('aircraftType.index', compact('aircraftTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $engineTypes = EngineType::orderBy('type', 'asc')->get();
        $manufacturers = AircraftType::orderBy('manufacturer', 'asc')->pluck('manufacturer')->unique();

        return view('aircraftType.create', compact('engineTypes', 'manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aircraftType = request()->validate([
            'manufacturer' => 'required',
            'type' => 'required|unique:aircraft_types',
            'left_engine_type_id' => 'nullable',
            'right_engine_type_id' => 'nullable',
            'front_engine_type_id' => 'nullable',
            'rear_engine_type_id' => 'nullable',
            'middle_engine_type_id' => 'nullable',
        ]); 

        AircraftType::Create($aircraftType);

        return redirect(route('aircraftType.index'))->with('success','Aircraft type created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AircraftType  $aircraftType
     * @return \Illuminate\Http\Response
     */
    public function show(AircraftType $aircraftType)
    {
        $aircrafts = $aircraftType->aircrafts;

        return view('aircraftType.show', compact('aircraftType', 'aircrafts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AircraftType  $aircraftType
     * @return \Illuminate\Http\Response
     */
    public function edit(AircraftType $aircraftType)
    {
        $engineTypes = EngineType::orderBy('type', 'asc')->get();

        return view('aircraftType.edit', compact('aircraftType', 'engineTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AircraftType  $aircraftType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AircraftType $aircraftType)
    {
        if ($aircraftType->aircrafts->count() != 0) return redirect(route('aircraftType.index'))->withErrors('Aircraft type not updated (has aircrafts)');

        request()->validate([
            'manufacturer' => 'required',
            'type' => 'required|unique:aircraft_types,type,'.$aircraftType->id,
            'left_engine_type_id' => 'nullable',
            'right_engine_type_id' => 'nullable',
            'front_engine_type_id' => 'nullable',
            'rear_engine_type_id' => 'nullable',
            'middle_engine_type_id' => 'nullable',
        ]);

        $aircraftType->manufacturer = $request->manufacturer;
        $aircraftType->type = $request->type;
        $aircraftType->left_engine_type_id = $request->left_engine_type_id;
        $aircraftType->right_engine_type_id = $request->right_engine_type_id;
        $aircraftType->front_engine_type_id = $request->front_engine_type_id;
        $aircraftType->rear_engine_type_id = $request->rear_engine_type_id;
        $aircraftType->middle_engine_type_id = $request->middle_engine_type_id;

        $aircraftType->save();

        return back()->with('success','Aircraft type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AircraftType  $aircraftType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AircraftType $aircraftType)
    {
        if ($aircraftType->aircrafts->count() != 0) return redirect(route('aircraftType.index'))->withErrors('Aircraft type not deleted (has aircrafts)');

        $aircraftType->delete();

        return redirect(route('aircraftType.index'))->with('success','Aircraft type deleted successfully');
    }

    public function autocompleteManufacturer(Request $request)
    {
        $manufacturers = AircraftType::where('manufacturer', 'like', '%' . $request->term . '%')->pluck('manufacturer')->unique();

        return response()->json($manufacturers);
    }
}
