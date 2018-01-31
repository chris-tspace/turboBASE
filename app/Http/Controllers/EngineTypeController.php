<?php

namespace App\Http\Controllers;

use App\EngineType;
use App\AircraftType;
use Illuminate\Http\Request;

class EngineTypeController extends Controller
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
        $engineTypes = EngineType::orderBy('type', 'asc')->get();

        return view('engineType.index', compact('engineTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('engineType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $engineType = request()->validate([
            'family' => 'required',
            'variant' => 'required',
            'type' => 'unique:engine_types'
        ]); 

        EngineType::Create($engineType);

        return redirect(route('engineType.index'))->with('success','Engine type created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EngineType  $engineType
     * @return \Illuminate\Http\Response
     */
    public function show(EngineType $engineType)
    {
        $engines = $engineType->engines;
        $aircraftTypes = AircraftType::orderBy('type', 'asc')
            ->where('left_engine_type_id', $engineType->id)
            ->orWhere('right_engine_type_id', $engineType->id)
            ->orWhere('front_engine_type_id', $engineType->id)
            ->orWhere('rear_engine_type_id', $engineType->id)
            ->orWhere('middle_engine_type_id', $engineType->id)
            ->get();

        return view('engineType.show', compact('engineType', 'engines', 'aircraftTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EngineType  $engineType
     * @return \Illuminate\Http\Response
     */
    public function edit(EngineType $engineType)
    {
        return view('engineType.edit', compact('engineType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EngineType  $engineType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EngineType $engineType)
    {
        $aircraftTypes = AircraftType::orderBy('type', 'asc')
            ->where('left_engine_type_id', $engineType->id)
            ->orWhere('right_engine_type_id', $engineType->id)
            ->orWhere('front_engine_type_id', $engineType->id)
            ->orWhere('rear_engine_type_id', $engineType->id)
            ->orWhere('middle_engine_type_id', $engineType->id)
            ->get();

        if ($engineType->engines->count() != 0) return redirect(route('engineType.show', ['id' => $engineType->id]))->withErrors('Engine type not updated (has engines)');
        else if ($aircraftTypes->count() != 0) return redirect(route('engineType.show', ['id' => $engineType->id]))->withErrors('Engine type not updated (has aircrafts)');

        request()->validate([
            'family' => 'required',
            'variant' => 'required',
            'type' => 'unique:engine_types,type,'.$engineType->id,
        ]);

        $engineType->family = $request->family;
        $engineType->variant = $request->variant;
        $engineType->type = $request->type;

        $engineType->save();

        return redirect(route('engineType.show', ['id' => $engineType->id]))->with('success','Engine type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EngineType  $engineType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EngineType $engineType)
    {
        $aircraftTypes = AircraftType::orderBy('type', 'asc')
            ->where('left_engine_type_id', $engineType->id)
            ->orWhere('right_engine_type_id', $engineType->id)
            ->orWhere('front_engine_type_id', $engineType->id)
            ->orWhere('rear_engine_type_id', $engineType->id)
            ->orWhere('middle_engine_type_id', $engineType->id)
            ->get();

        if ($engineType->engines->count() != 0) return redirect(route('engineType.show', ['id' => $engineType->id]))->withErrors('Engine type not deleted (has engines)');
        else if ($aircraftTypes->count() != 0) return redirect(route('engineType.show', ['id' => $engineType->id]))->withErrors('Engine type not deleted (has aircrafts)');
    
        $engineType->delete();

        return redirect(route('engineType.index'))->with('success','Engine type deleted successfully');
    }

    public function autocompleteFamily(Request $request)
    {
        $families = EngineType::where('family', 'like', '%' . $request->term . '%')->pluck('family')->unique();

        return response()->json($families);
    }
}
