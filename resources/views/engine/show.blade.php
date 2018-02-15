@extends('layouts.master')

@section('content-header')
<h1>
  <a href="{{ route('engineType.show', ['id' => $engine->engineType->id]) }}">{{ $engine->engineType->type }}</a> - {{ $engine->serial_number }}
</h1>
@endsection

@section('content')
@include('layouts.message')
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
      </div>
      <div class="box-body">
        <table class="table table-striped">
          <tbody>
            <tr>
              <th style="width:20%;">Aircraft</th>
              <th style="width:20%;">Position</th>
              <th style="width:20%;">Date</th>
              <th style="width:40%;">Action</th>
            </tr>
            @if ($engine->aircraft_id == 0)
            <td>NONE</td>
            <td></td>
            <td>
              @if ($engine->date != null)
                removed {{ \Carbon\Carbon::parse($engine->date)->format('d-M-Y') }}
              @endif
            </td>
            <td>
            </td>
            @else
            <td><a role="button" class="btn btn-primary btn-xs" href="{{ route('aircraft.show', ['id' => $engine->aircraft->id]) }}">{{ $engine->aircraft->name() }}</a></td>
            <td><span style="vertical-align: middle;">{{ $engine->positionName() }}</span></td>
            <td>
              installed {{ \Carbon\Carbon::parse($engine->date)->format('d-M-Y') }}
            </td>
            <td>
            </td>
            @endif
          </tbody>
        </table>
      </div>
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
                    <input type="hidden" name="aircraft_id" id="aircraft_id" value="0">
                    <input type="hidden" name="engine_id" id="engine_id" value="{{$engine->id}}">
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
