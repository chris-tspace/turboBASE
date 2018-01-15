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
  <div class="col-md-4">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Aircraft Type Creation</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" method="POST" action="{{ route('aircraftType.store') }}"> {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            <label for="type" class="col-sm-2 control-label">type</label>
            <div class="col-sm-10">
              <input
              type="text" 
              class="form-control"
              style="text-transform:uppercase"
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
    form.type.value = form.type.value.toUpperCase();
  }
</script>
@endsection