@extends('layouts.master')

 @section('content-header')
<h1>
    Aircraft Creation
</h1>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <form class="form-horizontal" method="POST" action="{{ route('aircraft.store') }}"> {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group{{ $errors->has('aircraft_type_id') ? ' has-error' : '' }}">
            <label for="aircraft_type_id" class="col-sm-3 control-label">Type</label>
            <div class="col-sm-9">
              <select class="selectpicker"
              data-live-search="true"
              data-width="auto"
              id="aircraft_type_id"
              name="aircraft_type_id"
              value="{{ old('aircraft_type_id') }}"
              required>
                <option value='' {{ null == old('aircraft_type_id') ? 'selected' : '' }}></option>
                @foreach($manufacturers as $manufacturer)
                <optgroup label="{{ $manufacturer }}">
                  @foreach($aircraftTypes->where('manufacturer', $manufacturer) as $aircraftType)
                    <option value='{{ $aircraftType->id }}' 
                      {{ $aircraftType->id == old('aircraft_type_id') ? 'selected' : '' }}>
                      {{ $aircraftType->Name(true) }}
                    </option>
                  @endforeach
                </optgroup>
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
            <label for="serial_number" class="col-sm-3 control-label">Serial number</label>
            <div class="col-sm-9">
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
          <div class="form-group{{ $errors->has('manufacturer_code') ? ' has-error' : '' }}">
            <label for="manufacturer_code" class="col-sm-3 control-label">Manufacturer code</label>
            <div class="col-sm-9">
              <input
              type="text" 
              class="form-control"
              style="text-transform:uppercase"
              id="manufacturer_code"
              name="manufacturer_code"
              value="{{ old('manufacturer_code') }}"
              >
              @if ($errors->has('manufacturer_code'))
              <span class="help-block">
                <strong>{{ $errors->first('manufacturer_code') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
            <button type="submit" class="btn btn-primary" onclick="buildinput(this.form)">
              Create
            </button>
          </div>
          <a href="{{ route('aircraft.index') }}">
            <button type="button" class="btn btn-default">Cancel</button>
          </a>
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
    form.manufacturer_code.value = form.manufacturer_code.value.toUpperCase();
  }
</script>
@endsection