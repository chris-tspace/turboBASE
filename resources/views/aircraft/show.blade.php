@extends('layouts.master')

{{-- @section('content-header')
<h1>
    Aircrafts
    <small>Optional description</small>
</h1>
@endsection
--}}
@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Aircraft Show</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <div class="box-body">
        <div class="row">
          <label class="col-xs-6">Type</label>
          <div class="col-xs-6">
            {{ $aircraft->aircraftType->type }}
          </div>
        </div>
        <div class="row">
          <label class="col-xs-6">Serial Number</label>
          <div class="col-xs-6">
            {{ $aircraft->serial_number }}
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="pull-right">
          <a href="{{ route('aircraft.edit', ['id' => $aircraft->id]) }}">
            <button type="button" class="btn btn-primary">Edit</button>
          </a>
        </div>
        <form  class="form-inline" method="POST" action="{{ route('aircraft.destroy', ['id' => $aircraft->id]) }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <a href="{{ url()->previous() }}"><button type="button" class="btn btn-default">Back</button></a>
          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>          
        </form>
      </div>
      <!-- /.box-footer -->
    </div>
  </div>
</div>
@endsection