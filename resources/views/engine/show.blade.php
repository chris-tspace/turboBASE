@extends('layouts.master')

{{-- @section('content-header')
<h1>
    Engines
    <small>Optional description</small>
</h1>
@endsection
--}}
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Engine Show</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <div class="box-body">
        <div class="row">
          <label class="col-xs-6">Type</label>
          <div class="col-xs-6">
            {{ $engine->engineType->type }}
          </div>
        </div>
        <div class="row">
          <label class="col-xs-6">Serial Number</label>
          <div class="col-xs-6">
            {{ $engine->serial_number }}
          </div>
        </div>
        <div class="row">
            <label class="col-xs-6">Aircraft</label>
            <div class="col-xs-6">
                @if ($engine->aircraft)
                <a href="{{ route('aircraft.show', ['id' => $engine->aircraft->id]) }}">{{ $engine->aircraft->manufacturer_code }} - {{ $engine->aircraft->aircraftType->type }} ({{ $engine->aircraft->serial_number }})</a>
                @endif
            </div>
        </div>
        <div class="row">
            <label class="col-xs-6">Position</label>
            <div class="col-xs-6">
                @if ($engine->aircraft)
                {{ $engine->aircraft_position }}
                @endif
            </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="pull-right">
          <a href="{{ route('engine.edit', ['id' => $engine->id]) }}">
            <button
              type="button"
              class="btn btn-primary"
              {{ $engine->aircraft != null ? 'disabled' : '' }}>
              Edit
            </button>
          </a>
        </div>
        <form  class="form-inline" method="POST" action="{{ route('engine.destroy', ['id' => $engine->id]) }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <a href="{{ url()->previous() }}"><button type="button" class="btn btn-default">Back</button></a>
          <button
            type="submit"
            class="btn btn-danger"
            {{ $engine->aircraft != null ? 'disabled' : '' }}
            onclick="return confirm('Are you sure?')">
              Delete
          </button>          
        </form>
      </div>
      <!-- /.box-footer -->
    </div>
  </div>
</div>
@endsection