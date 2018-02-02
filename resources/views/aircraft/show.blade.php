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
        @if ($aircraft->aircraftType->left_engine_type_id != null)
          @if ($leftEngine != null)
            @include('aircraft.hasEngine', ['actualEngine' => $leftEngine, 'position' => 1, 'name' => 'left'])
          @else
            @include('aircraft.hasNoEngine', ['actualEngine' => $leftEngine, 'position' => 1, 'name' => 'left', 'engineType' => $aircraft->aircraftType->leftEngineType])
          @endif
        @endif
        @if ($aircraft->aircraftType->right_engine_type_id != null)
          @if ($rightEngine != null)
            @include('aircraft.hasEngine', ['actualEngine' => $rightEngine, 'position' => 2, 'name' => 'right'])
          @else
            @include('aircraft.hasNoEngine', ['actualEngine' => $rightEngine, 'position' => 2, 'name' => 'right', 'engineType' => $aircraft->aircraftType->rightEngineType])
          @endif
        @endif
        @if ($aircraft->aircraftType->front_engine_type_id != null)
          @if ($frontEngine != null)
            @include('aircraft.hasEngine', ['actualEngine' => $frontEngine, 'position' => 3, 'name' => 'front'])
          @else
            @include('aircraft.hasNoEngine', ['actualEngine' => $frontEngine, 'position' => 3, 'name' => 'front', 'engineType' => $aircraft->aircraftType->frontEngineType])
          @endif
        @endif
        @if ($aircraft->aircraftType->rear_engine_type_id != null)
          @if ($rearEngine != null)
            @include('aircraft.hasEngine', ['actualEngine' => $rearEngine, 'position' => 4, 'name' => 'rear'])
          @else
            @include('aircraft.hasNoEngine', ['actualEngine' => $rearEngine, 'position' => 4, 'name' => 'rear', 'engineType' => $aircraft->aircraftType->rearEngineType])
          @endif
        @endif
        @if ($aircraft->aircraftType->middle_engine_type_id != null)
          @if ($middleEngine != null)
            @include('aircraft.hasEngine', ['actualEngine' => $middleEngine, 'position' => 5, 'name' => 'middle'])
          @else
            @include('aircraft.hasNoEngine', ['actualEngine' => $middleEngine, 'position' => 5, 'name' => 'middle', 'engineType' => $aircraft->aircraftType->middleEngineType])
          @endif
        @endif
      </div>
      <div class="box-footer">
        <div class="pull-right">
          @if ( $engines->count() == 0 )
          <a href="{{ route('aircraft.edit', ['id' => $aircraft->id]) }}">
          @endif
            <button class="btn btn-primary"
              {{ $engines->count() != 0 ? 'disabled' : '' }}>
              Edit
            </button>
          @if ( $engines->count() == 0 )
          </a>
          @endif
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
  function buildinput(form) {
    form.serial_number.value = form.serial_number.value.toUpperCase();
    form.identification.value = form.engine_type_id.value + '_' + form.serial_number.value;
  }
</script>

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