@extends('layouts.master')

{{-- @section('content-header')
<h1>
    Aircraft Types
    <small>Optional description</small>
</h1>
@endsection
--}}
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Aircraft Type Show</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <div class="box-body">
        <div class="row">
          <label class="col-xs-3">Manufacturer</label>
          <div class="col-xs-9">
            {{ $aircraftType->manufacturer }}
          </div>
        </div>
        <div class="row">
          <label class="col-xs-3">Type</label>
          <div class="col-xs-9">
            {{ $aircraftType->type }}
          </div>
        </div>
        @if ($aircraftType->left_engine_type_id)
          <div class="row">
            <label class="col-xs-3">Engine left</label>
            <div class="col-xs-9">
                <a href="{{ route('engineType.show', ['id' => $aircraftType->leftEngineType->id]) }}">{{ $aircraftType->leftEngineType->type }}</a>
            </div>
          </div>
        @endif
        @if ($aircraftType->right_engine_type_id)
          <div class="row">
            <label class="col-xs-3">Engine right</label>
            <div class="col-xs-9">
                <a href="{{ route('engineType.show', ['id' => $aircraftType->rightEngineType->id]) }}">{{ $aircraftType->rightEngineType->type }}</a>
            </div>
          </div>
        @endif
        @if ($aircraftType->front_engine_type_id)
          <div class="row">
            <label class="col-xs-3">Engine front</label>
            <div class="col-xs-9">
                <a href="{{ route('engineType.show', ['id' => $aircraftType->frontEngineType->id]) }}">{{ $aircraftType->frontEngineType->type }}</a>
            </div>
          </div>
        @endif
        @if ($aircraftType->rear_engine_type_id)
          <div class="row">
            <label class="col-xs-3">Engine rear</label>
            <div class="col-xs-9">
                <a href="{{ route('engineType.show', ['id' => $aircraftType->rearEngineType->id]) }}">{{ $aircraftType->rearEngineType->type }}</a>
            </div>
          </div>
        @endif
        @if ($aircraftType->middle_engine_type_id)
          <div class="row">
            <label class="col-xs-3">Engine middle</label>
            <div class="col-xs-9">
                <a href="{{ route('engineType.show', ['id' => $aircraftType->middleEngineType->id]) }}">{{ $aircraftType->middleEngineType->type }}</a>
            </div>
          </div>
        @endif
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="pull-right">
          <a href="{{ route('aircraftType.edit', ['id' => $aircraftType->id]) }}">
            <button 
              type="button" 
              class="btn btn-primary" 
              {{ $aircraftType->aircrafts->count() != 0 ? 'disabled' : '' }}>
              Edit
            </button>
          </a>
        </div>
        <form  class="form-inline" method="POST" action="{{ route('aircraftType.destroy', ['id' => $aircraftType->id]) }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <a href="{{ url()->previous() }}"><button type="button" class="btn btn-default">Back</button></a>
          <button 
            type="submit" 
            class="btn btn-danger" 
            {{ $aircraftType->aircrafts->count() != 0 ? 'disabled' : '' }} 
            onclick="return confirm('Are you shure ?')">
            Delete
          </button>          
        </form>
        <hr>
        @include('aircraft.table')
      </div>
      <!-- /.box-footer -->
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function() {
    $('#table_aircraft').DataTable({
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