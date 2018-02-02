<?php

namespace App\Http\Controllers;

use App\Engine;
use App\EngineType;
use Illuminate\Http\Request;

class EngineController extends Controller
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
        $engines = Engine::orderBy('serial_number', 'asc')->get();

        return view('engine.index', compact('engines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $engineTypes = EngineType::orderBy('type', 'asc')->get();
        $families =  EngineType::orderBy('family', 'asc')->pluck('family')->unique();

        return view('engine.create', compact('engineTypes', 'families'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $engine = request()->validate([
            'engine_type_id' => 'required',
            'serial_number' => 'required',
            'identification' => 'unique:engines',
            'aircraft_id' => 'nullable',
            'aircraft_position' => 'required_with:aircraft_id',
            ]); 
            
        Engine::Create($engine);

        return redirect(route('engine.index'))->with('success','Engine created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\Response
     */
    public function show(Engine $engine)
    {
        return view('engine.show', compact('engine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\Response
     */
    public function edit(Engine $engine)
    {
        $engineTypes = EngineType::orderBy('type', 'asc')->get();
        $families =  EngineType::orderBy('family', 'asc')->pluck('family')->unique();

        return view('engine.edit', compact('engine', 'engineTypes', 'families'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Engine $engine)
    {
        if ($engine->aircraft != null) return redirect(route('engine.show', ['id' => $engine->id]))->withErrors('Engine not updated (has aircrafts)');

        request()->validate([
            'engine_type_id' => 'required',
            'serial_number' => 'required',
            'identification' => 'unique:engines,identification,'.$engine->id,
            'aircraft_id' => 'nullable',
            'aircraft_position' => 'required_with:aircraft_id',
        ]);

        $engine->engine_type_id = $request->engine_type_id;
        $engine->serial_number = $request->serial_number;
        $engine->identification = $request->identification;
        $engine->aircraft_id = $request->aircraft_id;
        $engine->aircraft_position = $request->aircraft_position;
        
        $engine->save();

        return redirect(route('engine.show', ['id' => $engine->id]))->with('success','Engine updated successfully');
    }

    public function removeAircraft(Request $request, Engine $engine)
    {
        $engine->aircraft_id = null;
        $engine->aircraft_position = null;
        
        $engine->save();

        return back()->with('success','Engine updated successfully');
    }

    public function installAircraft(Request $request)
    {
        $engine = Engine::where('engine_type_id', $request->engine_type_id)
         ->where('serial_number', $request->serial_number)
         ->first();

        if ($engine && $engine->aircraft_id) return back()->withErrors('Engine ' . $engine->engineType->type . ' - ' . $engine->serial_number . ' already installed');
        switch ($request->action) {
            case 'install':
            if (!$engine) return back()->withErrors('Engine ' . $request->engine_type_name . ' - ' . $request->serial_number . ' doesn\'t exist');
            break;

            case 'create':
            if (!$engine) {
                $engine = request()->validate([
                    'engine_type_id' => 'required',
                    'serial_number' => 'required',
                    'identification' => 'unique:engines',
                    'aircraft_id' => 'required',
                    'aircraft_position' => 'required',
                    ]); 

                    $engine = Engine::Create($engine);

                    $engine->aircraft_id = $request->aircraft_id;
                    $engine->aircraft_position = $request->aircraft_position;
            
                    $engine->save();                    

                return back()->with('success','Engine created & installed successfully');
            }
        }
      
        request()->validate([
            'aircraft_id' => 'required',
            'aircraft_position' => 'required',
        ]);

        $engine->aircraft_id = $request->aircraft_id;
        $engine->aircraft_position = $request->aircraft_position;

        $engine->save();

        return back()->with('success','Engine updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Engine $engine)
    {
        if ($engine->aircraft != null) return redirect(route('engine.show', ['id' => $engine->id]))->withErrors('Engine not deleted (has aircrafts)');

        $engine->delete();

        return redirect(route('engine.index'))->with('success','Engine deleted successfully');
    }
}
