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

        return view('engine.create', compact('engineTypes'));
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
            'ident' => 'unique:engines',
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

        return view('engine.edit', compact('engine', 'engineTypes'));
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
        request()->validate([
            'engine_type_id' => 'required',
            'serial_number' => 'required',
            'ident' => 'unique:engines,ident,'.$engine->id,
        ]);

        $engine->engine_type_id = $request->engine_type_id;
        $engine->serial_number = $request->serial_number;

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
        $engine->delete();

        return redirect(route('engine.index'))->with('success','Engine deleted successfully');
    }
}
