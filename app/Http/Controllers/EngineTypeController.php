<?php

namespace App\Http\Controllers;

use App\EngineType;
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

        return view('engineType.show', compact('engineType', 'engines'));
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
        if ($engineType->engines->count() != 0) return redirect(route('engineType.index'))->withErrors('Engine type not updated (has engines)');

        request()->validate([
            'family' => 'required',
            'variant' => 'required',
            'type' => 'unique:engine_types,type,'.$engineType->id,
        ]);

        $engineType->family = $request->family;
        $engineType->variant = $request->variant;
        $engineType->type = $request->type;

        $engineType->save();

        return back()->with('success','Engine type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EngineType  $engineType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EngineType $engineType)
    {
        if ($engineType->engines->count() != 0) return redirect(route('engineType.index'))->withErrors('Engine type not deleted (has engines)');

        $engineType->delete();

        return redirect(route('engineType.index'))->with('success','Engine type deleted successfully');
    }
}
