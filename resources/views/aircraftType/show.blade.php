@extends('layouts.master')

@section('content-header')
<h1>
    {{ $aircraftType->type }} - {{ $aircraftType->manufacturer }}
</h1>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">{{ ($aircraftTypeVersions->count() == 1 ? 'Composition' : 'Compositions') }}</h3>
      </div>
      <div class="box-body">
        @include('layouts.message')
        <br>
        @if ($aircraftTypeVersions->count() > 1)
        <div class="nav-tabs-custom">	
          <ul class="nav nav-tabs">
            @foreach ($aircraftTypeVersions as $aircraftTypeVersion)
              <li class="{{ $aircraftType->id == $aircraftTypeVersion->id ? 'active' : '' }}">
                <a 
                class="nav-link"
                href="{{ route('aircraftType.show', ['id' => $aircraftTypeVersion->id]) }}"
                >
                {{ $aircraftTypeVersion->version }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="row">
          <label class="col-xs-3">Active</label>
          <div class="col-xs-9">
              {{ $aircraftType->active ? 'YES' : 'NO' }}
          </div>
        </div>
        @endif
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
      <div class="box-footer">
        <div class="pull-right">
          <a href="{{ route('aircraftType.createVersion', ['id' => $aircraftType->id]) }}">
            <button class="btn btn-primary">
              <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Composition
            </button>
          </a>
          @if ( $aircraftType->aircrafts->count() == 0 )
          <a href="{{ route('aircraftType.edit', ['id' => $aircraftType->id]) }}">
          @endif
            <button class="btn btn-primary" 
              {{ $aircraftType->aircrafts->count() != 0 ? 'disabled' : '' }}>
              Edit
            </button>
          @if ( $aircraftType->aircrafts->count() == 0 )
          </a>
          @endif
          </div>
        <form  class="form-inline" method="POST" action="{{ route('aircraftType.destroy', ['id' => $aircraftType->id]) }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <a href="{{ route('aircraftType.index') }}">
            <button type="button" class="btn btn-default">Cancel</button>
          </a>
          <button 
            type="submit" 
            class="btn btn-danger"
            {{ ($aircraftType->aircrafts->count() != 0) ? 'disabled' : '' }} 
            onclick="return confirm('Are you shure ?')">
            Delete
          </button>          
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Aircrafts</h3>
      </div>
      <div class="box-body">
        @include('aircraft.table')
      </div>
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