@extends('layouts.master')

@section('content-header')
@endsection

@section('content')
<div class="row">
  <div class="col-md-5">
    <div class="box box-info">
      <div class="box-header with-border">
        <div class="pull-right">
          <a href="{{ route('engine.create') }}">
            <button class="btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Create
            </button>
          </a>
        </div>
        <h3 class="box-title">Engine Index</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        @include('layouts.message')
        @include('engine.table')
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function() {
    $('#table_engine').DataTable({
      "columnDefs": [
      { "visible": false, "targets": [0] }
      ],
      "order": [[ 0, 'asc' ], [ 1, 'asc' ], [ 2, 'asc' ]],
      rowGroup: {
        dataSrc: 0,
      }
    } );
  } );
</script>
@endsection