@extends('layouts.master')

@section('content-header')
<h1>
    {{ $engineType->type }}
</h1>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <form class="form-horizontal" method="POST" action="{{ route('engineType.update', ['id' => $engineType->id]) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="box-body">
          @include('layouts.message')
          <div class="form-group{{ $errors->has('family') ? ' has-error' : '' }}">
            <label for="family" class="col-sm-3 control-label">Family</label>

            <div class="col-sm-9">
              <input
              type="text" 
              class="form-control"
              style="text-transform:uppercase"
              id="family"
              name="family"
              value="{{ $engineType->family }}"
              autofocus
              required>
              @if ($errors->has('family'))
              <span class="help-block">
                <strong>{{ $errors->first('family') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('variant') ? ' has-error' : '' }}">
            <label for="variant" class="col-sm-3 control-label">Variant</label>

            <div class="col-sm-9">
              <input
              type="text" 
              class="form-control"
              style="text-transform:uppercase"
              id="variant"
              name="variant"
              value="{{ $engineType->variant }}"
              required>
              @if ($errors->has('variant'))
              <span class="help-block">
                <strong>{{ $errors->first('variant') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            <div class="col-sm-12">
              <input 
              type="hidden" 
              id="type"
              name="type"
              value="">
              @if ($errors->has('type'))
              <span class="help-block">
                <strong>{{ $errors->first('type') }}</strong>
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
          <a href="{{ route('engineType.show', ['id' => $engineType->id]) }}">
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
    form.family.value = form.family.value.toUpperCase();
    form.variant.value = form.variant.value.toUpperCase();
    form.type.value = form.family.value + ' ' + form.variant.value;
  }

  $('#family').autocomplete({
    source : '{{ route('engineType.autocompleteFamily') }}',
  });
</script>
@endsection