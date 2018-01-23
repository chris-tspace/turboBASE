@extends('layouts.master')

@section('content-header')
@endsection

@section('content')

<div class="row">
  <div class="col-md-10">
    <div class="box box-info">
      <div class="box-header with-border">
        <div class="pull-right">
          <a href="{{ route('engineType.create') }}">
            <button class="btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Create
            </button>
          </a>
        </div>
        <h3 class="box-title">Engine Type Index</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          @include('layouts.message')
          <table class="table" id="table_engineType">
          <thead>
            <tr>
              <th class="text-center">Family</th>
              <th class="text-center">Variant</th>
              <th class="text-center">Type</th>
              <th class="text-center">Engines</th>
            </tr>
          </thead>
          <tbody>
            @foreach($engineTypes as $item)
            <tr class="item{{$item->id}}">
              <td>{{$item->family}}</td>  
              <td>{{$item->variant}}</td>
              <td><a href="{{ route('engineType.show', ['id' => $item->id]) }}">{{$item->type}}</a></td>
              <td>{{ $item->engines->count() }}</td>
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
    $('#table_engineType').DataTable({
      "columnDefs": [
      { "visible": false, "targets": [0, 1] }
      ],
      "order": [[ 0, 'asc' ], [ 1, 'asc' ]],
      rowGroup: {
        dataSrc: 0,
      }
    } );
  } );
</script>
@endsection