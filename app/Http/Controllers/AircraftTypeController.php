<?php

namespace App\Http\Controllers;

use App\AircraftType;
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
        return view('aircraftType.create');
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
            'type' => 'required|unique:aircraft_types'
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
        return view('aircraftType.edit', compact('aircraftType'));
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
            'type' => 'required|unique:aircraft_types,type,'.$aircraftType->id,
        ]);

        $aircraftType->type = $request->type;

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
}