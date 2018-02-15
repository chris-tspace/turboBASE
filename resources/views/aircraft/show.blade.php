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
        <table class="table table-striped">
          <tbody>
            <tr>
              <th style="width:20%;">Position</th>
              <th style="width:20%;">Engine</th>
              <th style="width:20%;">Date</th>
              <th style="width:40%;">Action</th>
            </tr>
            @if ($aircraft->aircraftType->left_engine_type_id != null)
            <tr>
              @if ($leftEngine != null)
                @include('aircraft.hasEngine', ['actualEngine' => $leftEngine, 'position' => 1, 'name' => 'left'])
              @else
                @include('aircraft.hasNoEngine', ['actualEngineRemovalPost' => $leftEngineRemovalPost, 'position' => 1, 'name' => 'left', 'engineType' => $aircraft->aircraftType->leftEngineType])
              @endif
            </tr>
            @endif
            @if ($aircraft->aircraftType->right_engine_type_id != null)
            <tr>
              @if ($rightEngine != null)
                @include('aircraft.hasEngine', ['actualEngine' => $rightEngine, 'position' => 2, 'name' => 'right'])
              @else
                @include('aircraft.hasNoEngine', ['actualEngineRemovalPost' => $rightEngineRemovalPost, 'position' => 2, 'name' => 'right', 'engineType' => $aircraft->aircraftType->rightEngineType])
              @endif
            </tr>
            @endif
            @if ($aircraft->aircraftType->front_engine_type_id != null)
            <tr>
              @if ($frontEngine != null)
                @include('aircraft.hasEngine', ['actualEngine' => $frontEngine, 'position' => 3, 'name' => 'front'])
              @else
                @include('aircraft.hasNoEngine', ['actualEngineRemovalPost' => $frontEngineRemovalPost, 'position' => 3, 'name' => 'front', 'engineType' => $aircraft->aircraftType->frontEngineType])
              @endif
            </tr>
            @endif
            @if ($aircraft->aircraftType->rear_engine_type_id != null)
            <tr>
              @if ($rearEngine != null)
                @include('aircraft.hasEngine', ['actualEngine' => $rearEngine, 'position' => 4, 'name' => 'rear'])
              @else
                @include('aircraft.hasNoEngine', ['actualEngineRemovalPost' => $rearEngineRemovalPost, 'position' => 4, 'name' => 'rear', 'engineType' => $aircraft->aircraftType->rearEngineType])
              @endif
            </tr>
            @endif
            @if ($aircraft->aircraftType->middle_engine_type_id != null)
            <tr>
              @if ($middleEngine != null)
                @include('aircraft.hasEngine', ['actualEngine' => $middleEngine, 'position' => 5, 'name' => 'middle'])
              @else
                @include('aircraft.hasNoEngine', ['actualEngineRemovalPost' => $middleEngineRemovalPost, 'position' => 5, 'name' => 'middle', 'engineType' => $aircraft->aircraftType->middleEngineType])
              @endif
            </tr>
            @endif
          </tbody>
        </table>
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
        <div class="pull-right">
          <button class="btn btn-info" data-toggle="modal" data-target="#addPost">
              Add post
          </button>
          &nbsp;
        </div>
        <div>
          <div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="addPost" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                  <h4 class="modal-title">Add post</h4>
                </div>
                <form  class="form-horizontal" role="form" method="POST" action="{{ route('post.store') }}">
                  {{ csrf_field() }}
                  <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
                    <input type="hidden" name="aircraft_id" id="aircraft_id" value="{{$aircraft->id}}">
                    <input type="hidden" name="engine_id" id="engine_id" value="0">
                    <input type="hidden" name="aircraft_position" id="aircraft_position" value="0">
                    <input type="hidden" name="type" id="type" value="1">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <textarea
                          name="body"
                          id="body"
                          style="resize: vertical;"
                          class="form-control"
                          rows="3"
                          placeholder="Your comment..."
                          autofocus></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="date" class="col-sm-3 control-label">Post date</label>
                      <div class="col-sm-9">
                        <input type="text"
                        id="date"
                        name="date"
                        class="form-control"
                        value="{{ now() }}"
                        autofocus>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <form  class="form-inline" method="POST" action="{{ route('aircraft.destroy', ['id' => $aircraft->id]) }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <a href="{{ route('aircraft.index') }}">
            <button type="button" class="btn btn-default">Cancel</button>
          </a>
          &nbsp;
          <button
            type="submit"
            class="btn btn-danger"
            {{ $engines->count() != 0 ? 'disabled' : '' }}
            onclick="return confirm('DELETE - Are you sure?')">
            Delete
          </button>          
        </form>
      </div>
    </div>
  </div>
</div>
@include('global.post')
@endsection

@section('js')
<script>
  function buildinput(form) {
    form.serial_number.value = form.serial_number.value.toUpperCase();
    form.identification.value = form.engine_type_id.value + '_' + form.serial_number.value;
  }
</script>
@endsection