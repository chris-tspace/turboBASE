@extends('layouts.master')

@section('content-header')
@endsection

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <div class="pull-right">
          <a href="{{ route('aircraft.create') }}">
            <button class="btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Create
            </button>
          </a>
        </div>
        <h3 class="box-title">Aircraft Index</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        @include('layouts.message')
        @include('aircraft.table')
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function() {
    $('#table_aircraft').DataTable({
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