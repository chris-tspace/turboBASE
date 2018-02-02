@extends('layouts.master')

@section('content-header')
<h1>
    Engine
</h1>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-body">
        @include('layouts.message')
        <div class="row">
          <label class="col-xs-3">Type</label>
          <div class="col-xs-9">
            {{ $engine->engineType->type }}
          </div>
        </div>
        <div class="row">
          <label class="col-xs-3">Serial Number</label>
          <div class="col-xs-9">
            {{ $engine->serial_number }}
          </div>
        </div>
        <div class="row">
            <label class="col-xs-3">Aircraft</label>
            <div class="col-xs-9">
                @if ($engine->aircraft)
                <a href="{{ route('aircraft.show', ['id' => $engine->aircraft->id]) }}">{{ $engine->aircraft->name() }}</a>
                @endif
            </div>
        </div>
        <div class="row">
            <label class="col-xs-3">Position</label>
            <div class="col-xs-9">
                @if ($engine->aircraft)
                {{ $engine->positionName() }}
                @endif
            </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="pull-right">
          @if ( $engine->aircraft == null )
          <a href="{{ route('engine.edit', ['id' => $engine->id]) }}">
          @endif
            <button class="btn btn-primary"
              {{ $engine->aircraft != null ? 'disabled' : '' }}>
              Edit
            </button>
          @if ( $engine->aircraft == null )
          </a>
          @endif
        </div>
        <form  class="form-inline" method="POST" action="{{ route('engine.destroy', ['id' => $engine->id]) }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <a href="{{ route('engine.index') }}">
            <button type="button" class="btn btn-default">Back</button>
          </a>
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