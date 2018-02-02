<?php

namespace App\Http\Controllers;

use App\Aircraft;
use App\AircraftType;
use App\Engine;
use Illuminate\Http\Request;

class AircraftController extends Controller
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
        $aircrafts = Aircraft::orderBy('serial_number', 'asc')->get();

        return view('aircraft.index', compact('aircrafts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aircraftTypes = AircraftType::orderBy('type', 'asc')->where('active', '1')->get();
        $manufacturers = AircraftType::orderBy('manufacturer', 'asc')->pluck('manufacturer')->unique();
        
        return view('aircraft.create', compact('aircraftTypes', 'manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aircraft = request()->validate([
            'aircraft_type_id' => 'required',
            'serial_number' => 'required',
            'manufacturer_code' => 'nullable',
            ]); 
            
        Aircraft::Create($aircraft);

        return redirect(route('aircraft.index'))->with('success','Aircraft created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function show(Aircraft $aircraft)
    {
        $engines = $aircraft->engines;
        $leftEngine = $engines->where('aircraft_position', '1')->first();
        $rightEngine = $engines->where('aircraft_position', '2')->first();
        $frontEngine = $engines->where('aircraft_position', '3')->first();
        $rearEngine = $engines->where('aircraft_position', '4')->first();
        $middleEngine = $engines->where('aircraft_position', '5')->first();

        return view('aircraft.show', compact('aircraft', 'engines', 'leftEngine', 'rightEngine', 'frontEngine', 'rearEngine', 'middleEngine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function edit(Aircraft $aircraft)
    {
        $aircraftTypes = AircraftType::orderBy('type', 'asc')->get();
        $manufacturers = AircraftType::orderBy('manufacturer', 'asc')->pluck('manufacturer')->unique();

        return view('aircraft.edit', compact('aircraft', 'aircraftTypes', 'manufacturers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aircraft $aircraft)
    {
        if ($aircraft->engines->count() != 0) return redirect(route('aircraft.show', ['id' => $aircraft->id]))->withErrors('Aircraft not updated (has engines)');
        
        request()->validate([
            'aircraft_type_id' => 'required',
            'serial_number' => 'required',
            'manufacturer_code' => 'nullable',
        ]);

        $aircraft->aircraft_type_id = $request->aircraft_type_id;
        $aircraft->serial_number = $request->serial_number;
        $aircraft->manufacturer_code = $request->manufacturer_code;
        
        $aircraft->save();

        return redirect(route('aircraft.show', ['id' => $aircraft->id]))->with('success','Aircraft updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aircraft $aircraft)
    {
        if ($aircraft->engines->count() != 0) return redirect(route('aircraft.show', ['id' => $aircraft->id]))->withErrors('Aircraft not deleted (has engines)');

        $aircraft->delete();

        return redirect(route('aircraft.index'))->with('success','Aircraft deleted successfully');
    }
}
