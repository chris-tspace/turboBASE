@extends('layouts.master')

{{-- @section('content-header')
<h1>
    Aircraft Types
    <small>Optional description</small>
</h1>
@endsection
--}}
@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Aircraft Type Creation</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" method="POST" action="{{ route('aircraftType.store') }}"> {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group{{ $errors->has('manufacturer') ? ' has-error' : '' }}">
            <label for="manufacturer" class="col-sm-3 control-label">Manufacturer</label>
            <div class="col-sm-9">
              <input
              type="text"
              class="form-control"
              list="list_manufacturer"
              id="manufacturer"
              name="manufacturer"
              value="{{ old('manufacturer') }}"
              autofocus
              required>
              @if ($errors->has('manufacturer'))
              <span class="help-block">
                <strong>{{ $errors->first('manufacturer') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
              <label for="type" class="col-sm-3 control-label">Type</label>
              <div class="col-sm-9">
                <input
                type="text" 
                class="form-control"
                id="type"
                name="type"
                value="{{ old('type') }}"
                autofocus
                required>
                @if ($errors->has('type'))
                <span class="help-block">
                  <strong>{{ $errors->first('type') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('ident') ? ' has-error' : '' }}">
              <div class="col-sm-9">
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
            <div class="form-group{{ $errors->has('left_engine_type_id') ? ' has-error' : '' }}">
            <label for="left_engine_type_id" class="col-sm-3 control-label">Left engine type</label>
            <div class="col-sm-9">
              <select class="selectpicker"
              data-live-search="true"
              data-width="auto"
              id="left_engine_type_id"
              name="left_engine_type_id"
              value="{{ old('left_engine_type_id') }}">
                <option value='' {{ null == old('left_engine_type_id') ? 'selected' : '' }}></option>
                @foreach($engineTypes as $engineType)
                  <option value='{{ $engineType->id }}' 
                    {{ $engineType->id == old('left_engine_type_id') ? 'selected' : '' }}>
                    {{ $engineType->type }}
                  </option>
                @endforeach
              </select>
              @if ($errors->has('left_engine_type_id'))
              <span class="help-block">
                <strong>{{ $errors->first('left_engine_type_id') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('right_engine_type_id') ? ' has-error' : '' }}">
            <label for="right_engine_type_id" class="col-sm-3 control-label">Right engine type</label>
            <div class="col-sm-9">
              <select class="selectpicker"
              data-live-search="true"
              data-width="auto"
              id="right_engine_type_id"
              name="right_engine_type_id"
              value="{{ old('right_engine_type_id') }}">
                <option value='' {{ null == old('right_engine_type_id') ? 'selected' : '' }}></option>
                @foreach($engineTypes as $engineType)
                  <option value='{{ $engineType->id }}' 
                    {{ $engineType->id == old('right_engine_type_id') ? 'selected' : '' }}>
                    {{ $engineType->type }}
                  </option>
                @endforeach
              </select>
              @if ($errors->has('right_engine_type_id'))
              <span class="help-block">
                <strong>{{ $errors->first('right_engine_type_id') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('front_engine_type_id') ? ' has-error' : '' }}">
            <label for="front_engine_type_id" class="col-sm-3 control-label">Front engine type</label>
            <div class="col-sm-9">
              <select class="selectpicker"
              data-live-search="true"
              data-width="auto"
              id="front_engine_type_id"
              name="front_engine_type_id"
              value="{{ old('front_engine_type_id') }}">
                <option value='' {{ null == old('front_engine_type_id') ? 'selected' : '' }}></option>
                @foreach($engineTypes as $engineType)
                  <option value='{{ $engineType->id }}' 
                    {{ $engineType->id == old('front_engine_type_id') ? 'selected' : '' }}>
                    {{ $engineType->type }}
                  </option>
                @endforeach
              </select>
              @if ($errors->has('front_engine_type_id'))
              <span class="help-block">
                <strong>{{ $errors->first('front_engine_type_id') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('rear_engine_type_id') ? ' has-error' : '' }}">
            <label for="rear_engine_type_id" class="col-sm-3 control-label">Rear engine type</label>
            <div class="col-sm-9">
              <select class="selectpicker"
              data-live-search="true"
              data-width="auto"
              id="rear_engine_type_id"
              name="rear_engine_type_id"
              value="{{ old('rear_engine_type_id') }}">
                <option value='' {{ null == old('rear_engine_type_id') ? 'selected' : '' }}></option>
                @foreach($engineTypes as $engineType)
                  <option value='{{ $engineType->id }}' 
                    {{ $engineType->id == old('rear_engine_type_id') ? 'selected' : '' }}>
                    {{ $engineType->type }}
                  </option>
                @endforeach
              </select>
              @if ($errors->has('rear_engine_type_id'))
              <span class="help-block">
                <strong>{{ $errors->first('rear_engine_type_id') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('middle_engine_type_id') ? ' has-error' : '' }}">
            <label for="middle_engine_type_id" class="col-sm-3 control-label">Middle engine type</label>
            <div class="col-sm-9">
              <select class="selectpicker"
              data-live-search="true"
              data-width="auto"
              id="middle_engine_type_id"
              name="middle_engine_type_id"
              value="{{ old('middle_engine_type_id') }}">
                <option value='' {{ null == old('middle_engine_type_id') ? 'selected' : '' }}></option>
                @foreach($engineTypes as $engineType)
                  <option value='{{ $engineType->id }}' 
                    {{ $engineType->id == old('middle_engine_type_id') ? 'selected' : '' }}>
                    {{ $engineType->type }}
                  </option>
                @endforeach
              </select>
              @if ($errors->has('middle_engine_type_id'))
              <span class="help-block">
                <strong>{{ $errors->first('middle_engine_type_id') }}</strong>
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
    form.ident.value = form.type.value + ' (' + form.manufacturer.value + ')';
  }

  $('#manufacturer').autocomplete({
    source : '{{ route('aircraftType.autocompleteManufacturer') }}',
  });
</script>
@endsection