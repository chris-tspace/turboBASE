@extends('layouts.master')

{{-- @section('content-header')
<h1>
    Engine Types
    <small>Optional description</small>
</h1>
@endsection
--}}
@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Engine Type Show</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <div class="box-body">
        <div class="row">
          <label class="col-xs-3">Family</label>
          <div class="col-xs-9">
            {{$engineType->family}}
          </div>
        </div>
        <div class="row">
          <label class="col-xs-3">Variant</label>
          <div class="col-xs-9">
            {{$engineType->variant}}
          </div>
        </div>
        <div class="row">
          <label class="col-xs-3">Type</label>
          <div class="col-xs-9">
            {{$engineType->type}}
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="pull-right">
          <a href="{{ route('engineType.edit', ['id' => $engineType->id]) }}">
            <button 
              type="button" 
              class="btn btn-primary" 
              {{ $engineType->engines->count() != 0 ? 'disabled' : '' }}>
              Edit
            </button>
          </a>
        </div>
        <form  class="form-inline" method="POST" action="{{ route('engineType.destroy', ['id' => $engineType->id]) }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <a href="{{ url()->previous() }}"><button type="button" class="btn btn-default">Back</button></a>
          <button 
            type="submit" 
            class="btn btn-danger" 
            {{ $engineType->engines->count() != 0 ? 'disabled' : '' }} 
            onclick="return confirm('Are you shure ?')">
            Delete
          </button>          
        </form>
        <hr>
        @include('engine.table')
      </div>
      <!-- /.box-footer -->
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