@extends('layouts.master')

@section('content-header')
<h1>
    Aircrafts
</h1>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-body">
        @include('layouts.message')
        @include('aircraft.table')
      </div>
      <div class="box-footer">
        <a href="{{ route('aircraft.create') }}">
          <button class="btn btn-primary">
            <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Create
          </button>
        </a>
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