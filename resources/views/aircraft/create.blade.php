@extends('layouts.master')

{{-- @section('content-header')
<h1>
    Aircraft
    <small>Optional description</small>
</h1>
@endsection
--}}
@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Aircraft Creation</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" method="POST" action="{{ route('aircraft.store') }}"> {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group{{ $errors->has('aircraft_type_id') ? ' has-error' : '' }}">
            <label for="aircraft_type_id" class="col-sm-4 control-label">Type</label>
            <div class="col-sm-8">
              <select class="selectpicker"
              data-live-search="true"
              data-width="auto"
              id="aircraft_type_id"
              name="aircraft_type_id"
              value="{{ old('aircraft_type_id') }}"
              required>
                @foreach($aircraftTypes as $aircraftType)
                <option value='{{$aircraftType->id }}'>{{ $aircraftType->type }}</option>
                @endforeach
              </select>
              @if ($errors->has('aircraft_type_id'))
              <span class="help-block">
                <strong>{{ $errors->first('aircraft_type_id') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('serial_number') ? ' has-error' : '' }}">
            <label for="serial_number" class="col-sm-4 control-label">Serial number</label>
            <div class="col-sm-8">
              <input
              type="text" 
              class="form-control"
              style="text-transform:uppercase"
              id="serial_number"
              name="serial_number"
              value="{{ old('serial_number') }}"
              required>
              @if ($errors->has('serial_number'))
              <span class="help-block">
                <strong>{{ $errors->first('serial_number') }}</strong>
              </span>
              @endif
            </div>
          </div>
          {{--  <div class="form-group{{ $errors->has('ident') ? ' has-error' : '' }}">
            <div class="col-sm-8">
              <input
              type="hidden" 
              id="ident"
              name="ident"
              value="">
              @if ($errors->has('ident'))
              <span class="help-block">
                <strong>{{ $errors->first('ident') }}</strong>
              </span>
              @endif
            </div>
          </div>  --}}
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
            <button type="submit" class="btn btn-primary" onclick="buildinput(this.form)">
              Create
            </button>
          </div>
          <a href="{{ url()->previous() }}"><button type="button" class="btn btn-default">Back</button></a>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  function buildinput(form) {
    form.serial_number.value = form.serial_number.value.toUpperCase();
    {{--  form.ident.value = form.aircraft_type_id + '_' + form.serial_number.value;  --}}
  }
</script>
@endsection