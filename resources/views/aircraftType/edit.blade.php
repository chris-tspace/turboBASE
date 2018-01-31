@extends('layouts.master')

@section('content-header')
<h1>
    {{ $aircraftType->type }} - {{ $aircraftType->manufacturer }}
</h1>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
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
          <div class="form-group{{ $errors->has('version') ? ' has-error' : '' }}">
            <label for="version" class="col-sm-3 control-label">Version</label>
            <div class="col-sm-9">
              <input 
              type="text" 
              class="form-control"
              id="version"
              name="version"
              value="{{ $aircraftType->version }}"
              readonly>
              @if ($errors->has('version'))
              <span class="help-block">
                <strong>{{ $errors->first('version') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
            <label for="active" class="col-sm-3 control-label">Active</label>
            <div class="col-sm-9">
              <input 
              class="checkbox"
              type="checkbox" 
              id="active"
              name="active"
              value="{{ $aircraftType->active }}"
              {{ $aircraftType->active ? 'checked' : '' }}
              >
              @if ($errors->has('active'))
              <span class="help-block">
                <strong>{{ $errors->first('active') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('identification_type') ? ' has-error' : '' }}">
            <div class="col-sm-9">
              <input 
              type="hidden" 
              id="identification_type"
              name="identification_type"
              value="">
              @if ($errors->has('identification_type'))
              <span class="help-block">
                <strong>{{ $errors->first('identification_type') }}</strong>
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
                @foreach($families as $family)
                <optgroup label="{{ $family }}">
                  @foreach($engineTypes->where('family', $family) as $engineType)
                    <option value='{{$engineType->id }}' 
                      {{ $engineType->id == $aircraftType->left_engine_type_id ? 'selected' : '' }}>
                      {{ $engineType->type }}
                    </option>
                  @endforeach
                </optgroup>
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
                @foreach($families as $family)
                <optgroup label="{{ $family }}">
                  @foreach($engineTypes->where('family', $family) as $engineType)
                    <option value='{{$engineType->id }}' 
                      {{ $engineType->id == $aircraftType->right_engine_type_id ? 'selected' : '' }}>
                      {{ $engineType->type }}
                    </option>
                  @endforeach
                </optgroup>
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
                @foreach($families as $family)
                <optgroup label="{{ $family }}">
                  @foreach($engineTypes->where('family', $family) as $engineType)
                    <option value='{{$engineType->id }}' 
                      {{ $engineType->id == $aircraftType->front_engine_type_id ? 'selected' : '' }}>
                      {{ $engineType->type }}
                    </option>
                  @endforeach
                </optgroup>
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
                @foreach($families as $family)
                <optgroup label="{{ $family }}">
                  @foreach($engineTypes->where('family', $family) as $engineType)
                    <option value='{{$engineType->id }}' 
                      {{ $engineType->id == $aircraftType->rear_engine_type_id ? 'selected' : '' }}>
                      {{ $engineType->type }}
                    </option>
                  @endforeach
                </optgroup>
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
                @foreach($families as $family)
                <optgroup label="{{ $family }}">
                  @foreach($engineTypes->where('family', $family) as $engineType)
                    <option value='{{$engineType->id }}' 
                      {{ $engineType->id == $aircraftType->middle_engine_type_id ? 'selected' : '' }}>
                      {{ $engineType->type }}
                    </option>
                  @endforeach
                </optgroup>
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
          <a href="{{ route('aircraftType.show', ['id' => $aircraftType->id]) }}">
            <button type="button" class="btn btn-default">
              Cancel
            </button>
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
    form.identification_type.value = form.type.value + ' (' + form.manufacturer.value + ')';
    form.identification.value = form.identification_type.value + ' - ' + form.version.value;
    if (form.active.value != null) form.active.value = "1";
    else form.active.value = "0";
  }

  $('#manufacturer').autocomplete({
    source : '{{ route('aircraftType.autocompleteManufacturer') }}',
  });
</script>
@endsection