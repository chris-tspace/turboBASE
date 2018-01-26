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
        <h3 class="box-title">Aircraft Type Update</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" method="POST" action="{{ route('aircraftType.update', ['id' => $aircraftType->id]) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="box-body">
          @include('layouts.message')
          <div class="form-group{{ $errors->has('manufacturer') ? ' has-error' : '' }}">
            <label for="manufacturer" class="col-sm-3 control-label">Manufacturer</label>

            <div class="col-sm-9">
              <input
              type="text" 
              class="form-control"
              id="manufacturer"
              name="manufacturer"
              value="{{ $aircraftType->manufacturer }}"
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
                value="{{ $aircraftType->type }}"
                autofocus
                required>
                @if ($errors->has('type'))
                <span class="help-block">
                  <strong>{{ $errors->first('type') }}</strong>
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
              value="{{ $aircraftType->left_engine_type_id }}">
                <option value='' {{ null == $aircraftType->left_engine_type_id ? 'selected' : '' }}></option>
                @foreach($engineTypes as $engineType)
                  <option value='{{$engineType->id }}' 
                    {{ $engineType->id == $aircraftType->left_engine_type_id ? 'selected' : '' }}>
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
              value="{{ $aircraftType->right_engine_type_id }}">
                <option value='' {{ null == $aircraftType->right_engine_type_id ? 'selected' : '' }}></option>
                @foreach($engineTypes as $engineType)
                  <option value='{{$engineType->id }}' 
                    {{ $engineType->id == $aircraftType->right_engine_type_id ? 'selected' : '' }}>
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
              value="{{ $aircraftType->front_engine_type_id }}">
                <option value='' {{ null == $aircraftType->front_engine_type_id ? 'selected' : '' }}></option>
                @foreach($engineTypes as $engineType)
                  <option value='{{$engineType->id }}' 
                    {{ $engineType->id == $aircraftType->front_engine_type_id ? 'selected' : '' }}>
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
              value="{{ $aircraftType->rear_engine_type_id }}">
                <option value='' {{ null == $aircraftType->rear_engine_type_id ? 'selected' : '' }}></option>
                @foreach($engineTypes as $engineType)
                  <option value='{{$engineType->id }}' 
                    {{ $engineType->id == $aircraftType->rear_engine_type_id ? 'selected' : '' }}>
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
              value="{{ $aircraftType->middle_engine_type_id }}">
                <option value='' {{ null == $aircraftType->middle_engine_type_id ? 'selected' : '' }}></option>
                @foreach($engineTypes as $engineType)
                  <option value='{{$engineType->id }}' 
                    {{ $engineType->id == $aircraftType->middle_engine_type_id ? 'selected' : '' }}>
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
              Update
            </button>
          </div>
          <a href="{{ route('aircraftType.show', ['id' => $aircraftType->id]) }}"><button type="button" class="btn btn-default">Back</button></a>
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
  }

  $('#manufacturer').autocomplete({
    source : '{{ route('aircraftType.autocompleteManufacturer') }}',
  });
</script>
@endsection