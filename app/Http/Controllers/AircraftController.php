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
        $aircraftTypes = AircraftType::orderBy('type', 'asc')->get();
        
        return view('aircraft.create', compact('aircraftTypes'));
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
        return view('aircraft.show', compact('aircraft'));
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

        return view('aircraft.edit', compact('aircraft', 'aircraftTypes'));
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
        request()->validate([
            'aircraft_type_id' => 'required',
            'serial_number' => 'required',
        ]);

        $aircraft->aircraft_type_id = $request->aircraft_type_id;
        $aircraft->serial_number = $request->serial_number;
        
        $aircraft->save();

        return back()->with('success','Aircraft updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aircraft  $aircraft
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aircraft $aircraft)
    {
        $aircraft->delete();

        return redirect(route('aircraft.index'))->with('success','Aircraft deleted successfully');
    }
}
