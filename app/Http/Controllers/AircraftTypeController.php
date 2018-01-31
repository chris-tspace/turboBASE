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
        $aircraftTypes = AircraftType::orderBy('type', 'asc')->where('active', '1')->get();
        $aircraftTypes = $aircraftTypes->unique('identification_type');

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
        $families =  EngineType::orderBy('family', 'asc')->pluck('family')->unique();

        return view('aircraftType.create', compact('engineTypes', 'manufacturers', 'families'));
    }

    public function createVersion(AircraftType $aircraftType)
    {
        $engineTypes = EngineType::orderBy('type', 'asc')->get();
        $aircraftTypeVersion = AircraftType::where('identification_type', $aircraftType->identification_type)
            ->pluck('version')
            ->last();
        $aircraftTypeVersion++;
        $families =  EngineType::orderBy('family', 'asc')->pluck('family')->unique();

        return view('aircraftType.createVersion', compact('aircraftType', 'engineTypes', 'aircraftTypeVersion', 'families'));
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
            'type' => 'required',
            'identification_type' => 'required',
            'version' => 'required',
            'identification' => 'unique:aircraft_types',
            'active' => 'boolean',
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
        $aircraftTypeVersions = AircraftType::where('identification_type', $aircraftType->identification_type)->get();

        return view('aircraftType.show', compact('aircraftType', 'aircrafts', 'aircraftTypeVersions'));
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
        $families =  EngineType::orderBy('family', 'asc')->pluck('family')->unique();

        return view('aircraftType.edit', compact('aircraftType', 'engineTypes', 'families'));
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
        if ($aircraftType->aircrafts->count() != 0) return redirect(route('aircraftType.show', ['id' => $aircraftType->id]))->withErrors('Aircraft type not updated (has aircrafts)');

        request()->validate([
            'manufacturer' => 'required',
            'type' => 'required',
            'identification_type' => 'required',
            'version' => 'required',
            'identification' => 'unique:aircraft_types,identification,'.$aircraftType->id,
            'active' => 'boolean',
            'left_engine_type_id' => 'nullable',
            'right_engine_type_id' => 'nullable',
            'front_engine_type_id' => 'nullable',
            'rear_engine_type_id' => 'nullable',
            'middle_engine_type_id' => 'nullable',
        ]);

        $aircraftType->manufacturer = $request->manufacturer;
        $aircraftType->type = $request->type;
        $aircraftType->identification_type = $request->identification_type;
        $aircraftType->version = $request->version;
        $aircraftType->identification = $request->identification;
        $aircraftType->active = $request->active;
        $aircraftType->left_engine_type_id = $request->left_engine_type_id;
        $aircraftType->right_engine_type_id = $request->right_engine_type_id;
        $aircraftType->front_engine_type_id = $request->front_engine_type_id;
        $aircraftType->rear_engine_type_id = $request->rear_engine_type_id;
        $aircraftType->middle_engine_type_id = $request->middle_engine_type_id;

        $aircraftType->save();

        return redirect(route('aircraftType.show', ['id' => $aircraftType->id]))->with('success','Aircraft type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AircraftType  $aircraftType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AircraftType $aircraftType)
    {
        if ($aircraftType->aircrafts->count() != 0) return redirect(route('aircraftType.show', ['id' => $aircraftType->id]))->withErrors('Aircraft type not deleted (has aircrafts)');

        $aircraftType->delete();

        return redirect(route('aircraftType.index'))->with('success','Aircraft type deleted successfully');
    }

    public function autocompleteManufacturer(Request $request)
    {
        $manufacturers = AircraftType::where('manufacturer', 'like', '%' . $request->term . '%')->pluck('manufacturer')->unique();

        return response()->json($manufacturers);
    }
}
