@extends('layouts.master')

@section('content-header')
<h1>
    Engine Creation
</h1>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <form class="form-horizontal" method="POST" action="{{ route('engine.store') }}"> {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group{{ $errors->has('engine_type_id') ? ' has-error' : '' }}">
            <label for="engine_type_id" class="col-sm-3 control-label">Type</label>
            <div class="col-sm-9">
              <select class="selectpicker"
              data-live-search="true"
              data-width="auto"
              id="engine_type_id"
              name="engine_type_id"
              value="{{ old('engine_type_id') }}"
              required>
                <option value='' {{ null == old('engine_type_id') ? 'selected' : '' }}></option>
                @foreach($families as $family)
                <optgroup label="{{ $family }}">
                  @foreach($engineTypes->where('family', $family) as $engineType)
                    <option value='{{$engineType->id }}' 
                      {{ $engineType->id == old('engine_type_id') ? 'selected' : '' }}>
                      {{ $engineType->type }}
                    </option>
                  @endforeach
                </optgroup>
                @endforeach
              </select>
              @if ($errors->has('engine_type_id'))
              <span class="help-block">
                <strong>{{ $errors->first('engine_type_id') }}</strong>
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
          <div class="form-group{{ $errors->has('identification') ? ' has-error' : '' }}">
            <div class="col-sm-9">
              <input
              type="hidden" 
              id="identification"
              name="identification"
              value="">
              @if ($errors->has('identification'))
              <span class="help-block">
                <strong>{{ $errors->first('identification') }}</strong>
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
          <a href="{{ route('engine.index') }}">
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
    form.identification.value = form.engine_type_id + '_' + form.serial_number.value;
  }
</script>
@endsection