@extends('layouts.master')

{{-- @section('content-header')
<h1>
    Engines
    <small>Optional description</small>
</h1>
@endsection
--}}
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Engine Update</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" method="POST" action="{{ route('engine.update', ['id' => $engine->id]) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="box-body">
          @include('layouts.message')
          <div class="form-group{{ $errors->has('engine_type_id') ? ' has-error' : '' }}">
            <label for="engine_type_id" class="col-sm-4 control-label">Type</label>
            <div class="col-sm-8">
              <select class="selectpicker"
              data-live-search="true"
              data-width="auto"
              id="engine_type_id"
              name="engine_type_id"
              value="{{ $engine->engine_type_id }}"
              required>
                <option value='' {{ null == $engine->engine_type_id ? 'selected' : '' }}></option>
                @foreach($engineTypes as $engineType)
                  <option value='{{ $engineType->id }}' 
                    {{ $engineType->id == $engine->engine_type_id ? 'selected' : '' }}>
                    {{ $engineType->type }}
                  </option>
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
            <label for="serial_number" class="col-sm-4 control-label">Serial number</label>
            <div class="col-sm-8">
              <input
              type="text" 
              class="form-control"
              style="text-transform:uppercase"
              id="serial_number"
              name="serial_number"
              value="{{ $engine->serial_number or old('serial_number') }}"
              required>
              @if ($errors->has('serial_number'))
              <span class="help-block">
                <strong>{{ $errors->first('serial_number') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('ident') ? ' has-error' : '' }}">
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
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
            <button type="submit" class="btn btn-primary" onclick="buildinput(this.form)">
              Update
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
    form.ident.value = form.engine_type_id + '_' + form.serial_number.value;
  }
</script>
@endsection