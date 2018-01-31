@extends('layouts.master')

@section('content-header')
<h1>
    {{ $aircraft->name() }}
    &nbsp;-&nbsp;
    <a href="{{ route('aircraftType.show', ['id' => $aircraft->aircraftType->id]) }}">
        {{ $aircraft->aircraftType->name() }}
    </a>
    &nbsp;-&nbsp;
    {{ $aircraft->aircraftType->manufacturer }}
</h1>
@endsection

@section('content')
@include('layouts.message')
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Composition</h3>
      </div>
      <div class="box-body">
        <br>
        @foreach($engines as $item)
          <div class="row">
            <label class="col-xs-3">Engine {{ $item->aircraft_position }}</label>
            <div class="col-xs-9">
                <a href="{{ route('engine.show', ['id' => $item->id]) }}">{{ $item->engineType->type }} - {{ $item->serial_number }}</a>
            </div>
          </div>
        @endforeach
      </div>
      <div class="box-footer">
        <div class="pull-right">
          <a href="{{ route('aircraft.edit', ['id' => $aircraft->id]) }}">
            <button class="btn btn-primary"
              {{ $engines->count() != 0 ? 'disabled' : '' }}>
              Edit
            </button>
          </a>
        </div>
        <form  class="form-inline" method="POST" action="{{ route('aircraft.destroy', ['id' => $aircraft->id]) }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <a href="{{ route('aircraft.index') }}">
            <button type="button" class="btn btn-default">Cancel</button>
          </a>
          <button
            type="submit"
            class="btn btn-danger"
            {{ $engines->count() != 0 ? 'disabled' : '' }}
            onclick="return confirm('Are you sure?')">
            Delete
          </button>          
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function() {
    $('#table_engine').DataTable({
      "columnDefs": [
      { "visible": false, "targets": [0] }
      ],
      "order": [[ 0, 'asc' ], [ 1, 'asc' ], [ 2, 'asc' ]],
      rowGroup: {
        dataSrc: 0,
      }
    } );
  } );
</script>
@endsection