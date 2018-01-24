@extends('layouts.master')

@section('content-header')
@endsection

@section('content')

<div class="row">
  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <div class="pull-right">
          <a href="{{ route('aircraftType.create') }}">
            <button class="btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Create
            </button>
          </a>
        </div>
        <h3 class="box-title">Aircraft Type Index</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          @include('layouts.message')
          <table class="table" id="table_aircraftType">
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