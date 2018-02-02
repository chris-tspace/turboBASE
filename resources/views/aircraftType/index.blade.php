@extends('layouts.master')

@section('content-header')
<h1>
    Aircraft Types
</h1>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-body">
        @include('layouts.message')
        <table class="table" cellspacing="0" width="100%" id="table_aircraftType">
          <thead>
            <tr>
              <th class="text-left">Manufacturer</th>
              <th class="text-left">Type</th>
              <th class="text-left">Aircrafts</th>
            </tr>
          </thead>
          <tbody>
            @foreach($aircraftTypes as $item)
            <tr class="item{{$item->id}}">
              <td>{{ $item->manufacturer }}</td>
              <td><a href="{{ route('aircraftType.show', ['id' => $item->id]) }}">{{$item->type}}</a></td>
              <td>{{ $item->aircrafts->count() }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="box-footer">
        <a href="{{ route('aircraftType.create') }}">
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
    $('#table_aircraftType').DataTable({
      "columnDefs": [
      { "visible": false, "targets": [0] }
      ],
      "order": [[ 0, 'asc' ], [ 1, 'asc' ]],
      rowGroup: {
        dataSrc: 0,
      }
    } );
  } );
</script>
@endsection